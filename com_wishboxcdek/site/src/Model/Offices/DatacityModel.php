<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license   GNU General Public License version 2 or later
 */
namespace Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek\Offices;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

\JLoader::register('JShoppingModelWishBoxCdekOfficesData', __DIR__ .'/WishboxcdekofficesdataModel.php');
\JLoader::register('JShoppingModelWishBoxCdekOfficesData', __DIR__ .'/Wishboxcdekofficesdatainterface.php');

/**
 *
 */
class DatacityModel extends DataModel implements DataInterface
{
	/**
	* Method returns array of offices use city
	*
	* @param	int 	city_code
	* @return	array
	*/
	public function getOffices(int $city_code, ?array $order_dimensions = null): array
	{
		// Если нет id города
		if ($city_code <= 0)
		{
			throw new \InvalidArgumentException('city_code must be greater than zero', 500);
		}

		$offices = [];

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
					'TRIM(o.nearest_station) AS nearest_station',
					'o.metro_station AS metro_station',
					'o.city_code AS city_id',
					'o.dimensions AS dimensions']
			)
			->from('#__jshopping_shipping_method_wishboxcdek_offices AS o')
			->where('o.city_code = '.$cityCode)
			->order('o.name ASC');

		$this->db->setQuery($query);
		$offices = $this->db->loadObjectList();

		if (count($offices))
		{
			$wishboxcdekcityTable = JSFactory::getTable('wishboxcdekcity');
			$wishboxcdekcity_table->load(['code' => $city_code]);

			foreach ($offices as $k => $office)
			{
				$offices[$k]->city = $wishboxcdekcity_table->cityname;

				if ($order_dimensions && $offices[$k]->type == 'POSTAMAT')
				{
					$offices[$k]->dimensions = json_decode($offices[$k]->dimensions, true);

					if (is_array($offices[$k]->dimensions) && count($offices[$k]->dimensions))
					{
						$office_dimensions = \WishBoxDimencion::arrayFromAccos($offices[$k]->dimensions);

						if (!\WishBoxDimencion::arrayInArray($order_dimensions, $office_dimensions))
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
