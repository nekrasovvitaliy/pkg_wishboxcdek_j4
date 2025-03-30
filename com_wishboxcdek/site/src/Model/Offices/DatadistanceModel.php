<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;
use Wishbox\Map\Point;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class DatadistanceModel extends DataModel implements DataInterface
{
	/**
	 * Method returns array of offices use distance
	 *
	 * @param	integer       $cityCode    City code
	 * @param	boolean|null  $allowedCod  Allowed cod
	 * @param   string        $type        Type
	 * @param	array|null    $packages    Packages
	 *
	 * @return    array     List of offices
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?bool $allowedCod = null, string $type = 'ALL', ?array $packages = null): array
	{
		$db = $this->getDatabase();

		if ($cityCode <= 0)
		{
			throw new InvalidArgumentException('city_code must be greater than zero', 500);
		}

		$offices = [];

		// Получаем координаты центра области офисов
		$avg = $this->getCityAvg($cityCode);

		if (!empty($avg->longitude) && !empty($avg->latitude))
		{
			// Получаем расстояние между самыми дальними офисами
			$distance = $this->getDistance($cityCode);

			$query = $db->createQuery()
				->select(
					[
						'o.id AS id',
						'o.address AS name',
						'o.code AS value',
						'o.code AS code',
						'o.address AS address',
						'o.phone AS phone',
						'o.note AS note',
						'o.type AS type',
						'o.location_latitude AS location_latitude',
						'o.location_longitude AS location_longitude',
						'o.work_time AS work_time',
						'o.is_dressing_room AS is_dressing_room',
						'o.have_cashless AS havecashless',
						'o.allowed_cod AS allowed_code',
						'o.nearest_station AS nearest_station',
						'o.nearest_metro_station AS metro_station',
						'o.city_code AS city_id',
						'IF (city_code <> ' . $cityCode . ', "1", "0") AS other_city',
						'c.cityname AS city'
					]
				)
				->from('#__wishboxcdek_offices AS o')
				->join('LEFT', '#__wishboxcdek_cities AS c ON c.code = o.city_code');

			if ($allowedCod)
			{
				$query->where('allowed_cod = ' . (int) $allowedCod);
			}

			if (is_array($packages) && count($packages))
			{
				$volumeWeight = $this->getVolumeWeight($packages);
				$query->where('weight_max >= ' . $volumeWeight);
			}

			$query->where(
				'(dist(' . $avg->longitude . ', ' . $avg->latitude
				. ', o.location_longitude, o.location_latitude) < ' . ($distance * 5) . ') || (city_code = "' . $cityCode . '")'
			)->order('other_city ASC');
			$query->order('o.address ASC');
			$db->setQuery($query);
			$offices = $db->loadObjectList();
		}

		return $offices;
	}

	/**
	 * @param	integer	 $cityCode	City code
	 *
	 * @return Point
	 *
	 * @since 1.0.0
	 */
	private function getCityAvg(int $cityCode): Point
	{
		if ($cityCode <= 0)
		{
			throw new InvalidArgumentException('city_code must be greater than zero', 500);
		}

		$db = $this->getDatabase();

		$query = $db->createQuery()
			->select(
				[
					'CAST(AVG(location_latitude) AS DECIMAL(12,10)) AS location_latitude',
					'CAST(AVG(location_longitude) AS DECIMAL(12,10)) AS location_longitude'
				]
			)
			->from('#__wishboxcdek_offices')
			->where('city_code = ' . $cityCode);

		$db->setQuery($query);

		$result = $db->loadObject();

		return new Point(floatval($result->location_latitude), floatval($result->location_longitude)); // phpcs:ignore
	}

	/**
	 * @param   integer  $cityCode  City code
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	private function getDistance(int $cityCode): int
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$query = $db->createQuery()
			->select('dist(MIN(location_longitude), MIN(location_latitude), MAX(location_longitude), MAX(location_latitude)) / 2')
			->from('#__wishboxcdek_offices')
			->where('city_code = ' . $cityCode);

		$db->setQuery($query);

		$distance = $db->loadResult();

		if ($distance == 0)
		{
			$distance = 5000;
		}

		return (int) $distance;
	}

	/**
	 * @param   array|null  $packages  Packages
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	private function getVolumeWeight(?array $packages): ?float
	{
		$volumeWeight = 0;

		if (is_array($packages) && count($packages))
		{
			foreach ($packages as $package)
			{
				$volumeWeight += $package->width * $package->height * $package->length / 5000;
			}
		}

		return $volumeWeight;
	}
}
