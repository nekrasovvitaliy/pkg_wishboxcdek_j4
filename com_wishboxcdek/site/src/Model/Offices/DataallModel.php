<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\Component\Wishboxcdek\Site\Entity\DimensionsEntity;
use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class DataallModel extends DataModel implements DataInterface
{
	/**
	 * Method returns array of offices use city
	 *
	 * @param   integer       $cityCode    City code
	 * @param   boolean|null  $allowedCod  Allowed cod
	 * @param   array|null    $packages    Min dimension
	 *
	 * @return    array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?bool $allowedCod = null, ?array $packages = null): array
	{
		$app = Factory::getApplication();
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$query = $db->getQuery(true)
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
					'TRIM(o.nearest_station) AS nearest_station',
					'o.nearest_metro_station AS metro_station',
					'o.city_code AS city_id',
					'o.dimensions AS dimensions']
			)
			->from('#__wishboxcdek_offices AS o');

		if ($packages && is_array($packages) && count($packages))
		{
			$volumeWeight = $this->getVolumeWeight($packages);
			$query->where('weight_max >= ' . $volumeWeight);
		}

		$query->order('o.address ASC');
		$db->setQuery($query);
		$offices = $db->loadObjectList();

		if (count($offices))
		{
			foreach ($offices as $k => $office)
			{
				if ($packages && is_array($packages) && $offices[$k]->type == 'POSTAMAT')
				{
					$offices[$k]->dimensions = json_decode($offices[$k]->dimensions, true);

					if ($offices[$k]->dimensions[0] == [])
					{
						unset($offices[$k]->dimensions[0]);
					}

					$offices[$k]->dimensions = array_values($offices[$k]->dimensions);
/*
					if (is_array($offices[$k]->dimensions) && count($offices[$k]->dimensions))
					{
						$officeDimensions = DimensionsEntity::arrayFromAccos($offices[$k]->dimensions);

						if (!DimensionsEntity::arrayInArray($packages, $officeDimensions))
						{
							unset($offices[$k]);
						}
					}*/
				}
			}
		}

		return $offices;
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
