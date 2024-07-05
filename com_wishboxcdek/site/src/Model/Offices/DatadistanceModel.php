<?php
/**
 * @copyright  2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

// phpcs:disable PSR1.Files.SideEffects
use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;
use Wishbox\Map\Point;

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
	 * @param	integer     $cityCode         City code
	 * @param	array|null  $orderDimensions  Order dimensions
	 *
	 * @return    array     List of offices
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?array $orderDimensions = null): array
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

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

			$query = $this->db->getQuery(true)
				->select(
					[
						'o.id AS id',
						'o.name AS name',
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
						'o.metro_station AS metro_station',
						'o.city_code AS city_id',
						'IF (city_code <> ' . $cityCode . ', "1", "0") AS other_city',
						'c.cityname AS city'
					]
				)
				->from('#__jshopping_shipping_method_wishboxcdek_offices AS o')
				->join('LEFT', '#__jshopping_shipping_method_wishboxcdek_cities AS c ON c.code = o.city_code')
				->where(
					'(dist(' . $avg->longitude . ', ' . $avg->latitude
					. ', o.location_longitude, o.location_latitude) < ' . ($distance * 1.1) . ') || (city_code = "' . $cityCode . '")'
				)
				->order('other_city ASC');
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

		$query = $this->db->getQuery(true)
			->select(
				[
					'CAST(AVG(location_latitude) AS DECIMAL(12,10)) AS location_latitude',
					'CAST(AVG(location_longitude) AS DECIMAL(12,10)) AS location_longitude'
				]
			)
			->from('#__jshopping_shipping_method_wishboxcdek_offices')
			->where('city_code = ' . $cityCode);

		$this->db->setQuery($query);

		$result = $this->db->loadObject();

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
		$query = $this->db->getQuery(true)
			->select('dist(MIN(location_longitude), MIN(location_latitude), MAX(location_longitude), MAX(location_latitude)) / 2')
			->from('#__wishboxcdek_offices')
			->where('city_code = ' . $cityCode);

		$this->db->setQuery($query);

		$distance = $this->db->loadResult();

		if ($distance == 0)
		{
			$distance = 5000;
		}

		return (int) $distance;
	}
}
