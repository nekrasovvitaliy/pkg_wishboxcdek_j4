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
class DatacityModel extends DataModel implements DataInterface
{
	/**
	 * Method returns array of offices use city
	 *
	 * @param   integer     $cityCode         City code
	 * @param   array|null  $orderDimensions  Min dimension
	 *
	 * @return    array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?array $orderDimensions = null): array
	{
		if ($cityCode <= 0)
		{
			throw new InvalidArgumentException('city_code must be greater than zero', 500);
		}

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
			->from('#__wishboxcdek_offices AS o')
			->where('o.city_code = ' . $cityCode)
			->order('o.address ASC');

		$db->setQuery($query);
		$offices = $db->loadObjectList();

		if (count($offices))
		{
			$wishboxcdekcityTable = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createTable('city', 'Administrator');

			$wishboxcdekcityTable->load(['code' => $cityCode]);

			foreach ($offices as $k => $office)
			{
				$offices[$k]->city = $wishboxcdekcityTable->cityname;

				if ($orderDimensions && $offices[$k]->type == 'POSTAMAT')
				{
					$offices[$k]->dimensions = json_decode($offices[$k]->dimensions, true);

					if ($offices[$k]->dimensions[0] == [])
					{
						unset($offices[$k]->dimensions[0]);
					}

					$offices[$k]->dimensions = array_values($offices[$k]->dimensions);

					if (is_array($offices[$k]->dimensions) && count($offices[$k]->dimensions))
					{
						$officeDimensions = DimensionsEntity::arrayFromAccos($offices[$k]->dimensions);

						if (!DimensionsEntity::arrayInArray($orderDimensions, $officeDimensions))
						{
							unset($offices[$k]);
						}
					}
				}
			}
		}

		return $offices;
	}
}
