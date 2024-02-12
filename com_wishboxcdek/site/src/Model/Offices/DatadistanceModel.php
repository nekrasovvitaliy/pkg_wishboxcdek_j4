<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license   GNU General Public License version 2 or later
 */
namespace Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek\Offices;

defined('_JEXEC') or die;

\JLoader::register('JShoppingModelWishBoxCdekOfficesData', __DIR__ .'/WishboxcdekofficesdataModel.php');
\JLoader::register('JShoppingModelWishBoxCdekOfficesData', __DIR__ .'/Wishboxcdekofficesdatainterface.php');


/**
 *
 */
class DatadistanceModel extends DataModel implements DataInterface
{
	/**
	* Method returns array of offices use distance
	*
	* @param	int		city_code
	* @param	array	order_dimensions
	* @return	array	List of offices
	*/
	public function getOffices(int $city_code, ?array $order_dimensions = null): array
	{
		// Если нет id города
		if ($city_code <= 0)
		{
			throw new InvalidArgumentException('city_code must be greater than zero', 500);
		}

		$offices = [];

		// Получаем координаты центра области офисов
		$avg = $this->getCityAvg($city_code);

		if (!empty($avg->longitude) && !empty($avg->latitude))
		{
			// Получаем расстояние между самыми дальними офисами
			$distance = $this->getDistance($city_code);

			$query = $this->db->getQuery(true);
			$query->select('o.id AS id');
			$query->select('o.name AS name');
			$query->select('o.code AS value');
			$query->select('o.code AS code');
			$query->select('o.address AS address'); 
			$query->select('o.phone AS phone');
			$query->select('o.note AS note');
			$query->select('o.type AS type');
			$query->select('o.location_latitude AS location_latitude');
			$query->select('o.location_longitude AS location_longitude');
			$query->select('o.work_time AS work_time');
			$query->select('o.is_dressing_room AS is_dressing_room');
			$query->select('o.have_cashless AS havecashless');
			$query->select('o.allowed_cod AS allowed_code');
			$query->select('o.nearest_station AS nearest_station');
			$query->select('o.metro_station AS metro_station');
			$query->select('o.city_code AS city_id');
			$query->select('IF (city_code <> '.$city_code.', "1", "0") AS other_city');
			$query->select('c.cityname AS city');
			$query->from('#__jshopping_shipping_method_wishboxcdek_offices AS o');
			$query->join('LEFT', '#__jshopping_shipping_method_wishboxcdek_cities AS c ON c.code = o.city_code');
			$query->where('(dist('.$avg->longitude.', '.$avg->latitude.', o.location_longitude, o.location_latitude) < '.($distance * 1.1).') || (city_code = "'.$city_code.'")');
			$query->order('other_city ASC');

			$this->db->setQuery($query);
			
			$offices = $this->db->loadObjectList();
		}

		return $offices;
	}
	
	
	/**
	 * 
	 *
	 * @param	int		city_code
	 * @return	WishBox\Map\Point	Coordinates of center offices
	 */
	private function getCityAvg(int $city_code): \Wishbox\Map\Point
	{
		// 
		// 
		if ($city_code <= 0)
		{
			// 
			// 
			throw new InvalidArgumentException('city_code must be greater than zero', 500);
		}
		// 
		// 
		$query = $this->db->getQuery(true);
		// 
		// 
		$query->select('CAST(AVG(location_latitude) AS DECIMAL(12,10)) AS location_latitude');
		// 
		// 
		$query->select('CAST(AVG(location_longitude) AS DECIMAL(12,10)) AS location_longitude');
		// 
		// 
		$query->from('#__jshopping_shipping_method_wishboxcdek_offices');
		// 
		// 
		$query->where('city_code = '.$city_code);
		// 
		// 
		$this->db->setQuery($query);
		// 
		// 
		$result = $this->db->loadObject();
		// 
		// 
		$avg = new \Wishbox\Map\Point(floatval($result->location_latitude), floatval($result->location_longitude));
		// 
		// 
		return $avg;
	}
	
	
	/**
	 * 
	 */
	private function getDistance(int $city_code): int
	{
		$query = $this->db->getQuery(true)
			->select('dist(MIN(location_longitude), MIN(location_latitude), MAX(location_longitude), MAX(location_latitude)) / 2')
			->from('#__jshopping_shipping_method_wishboxcdek_offices')
			->where('city_code = '.$city_code);

		$this->db->setQuery($query);

		$distance = $this->db->loadResult();

		if ($distance == 0)
		{
			$distance = 5000;
		}

		return (int)$distance;
	}
}