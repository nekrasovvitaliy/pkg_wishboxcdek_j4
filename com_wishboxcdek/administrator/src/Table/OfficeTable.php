<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Administrator\Table;

use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since       1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficeTable extends BaseTable
{
	/**
	 * @var string|null $code Code
	 *
	 * @since 1.0.0
	 */
	public ?string $code = null;

	/**
	 * @var string|null $country_code Country code
	 *
	 * @since 1.0.0
	 */
	public ?string $country_code = null;

	/**
	 * @var integer|null $region_code Region code
	 *
	 * @since 1.0.0
	 */
	public ?int $region_code = null;

	/**
	 * @var integer|null $city_code City code
	 *
	 * @since 1.0.0
	 */
	public ?int $city_code = null;

	/**
	 * @var string|null $city City name
	 *
	 * @since 1.0.0
	 */
	public ?string $city = null;

	/**
	 * @var string|null $work_time Work time
	 *
	 * @since 1.0.0
	 */
	public ?string $work_time = null;

	/**
	 * @var string|null $address Address
	 *
	 * @since 1.0.0
	 */
	public ?string $address = null;

	/**
	 * @var string|null $address_full Full address
	 *
	 * @since 1.0.0
	 */
	public ?string $address_full = null;

	/**
	 * @var string|null $phone Phone
	 *
	 * @since 1.0.0
	 */
	public ?string $phone = null;

	/**
	 * @var string|null $note Note
	 *
	 * @since 1.0.0
	 */
	public ?string $note = null;

	/**
	 * @var float|null $location_longitude Location longitude
	 *
	 * @since 1.0.0
	 */
	public ?float $location_longitude = null;

	/**
	 * @var float|null $location_latitude Location latitude
	 *
	 * @since 1.0.0
	 */
	public ?float $location_latitude = null;

	/**
	 * @var string|null $type Delivery point type
	 *
	 * @since 1.0.0
	 */
	public ?string $type = null;

	/**
	 * @var string|null $owner_code Owner code
	 *
	 * @since 1.0.0
	 */
	public ?string $owner_code = null;

	/**
	 * @var string|null $is_dressing_room Dressing room flag
	 *
	 * @since 1.0.0
	 */
	public ?string $is_dressing_room = null;

	/**
	 * @var string|null $have_cashless Cashless payment flag
	 *
	 * @since 1.0.0
	 */
	public ?string $have_cashless = null;

	/**
	 * @var string|null $allowed_cod Allowed cash on delivery flag
	 *
	 * @since 1.0.0
	 */
	public ?string $allowed_cod = null;

	/**
	 * @var string|null $nearest_station Nearest station
	 *
	 * @since 1.0.0
	 */
	public ?string $nearest_station = null;

	/**
	 * @var string|null $nearest_metro_station Nearest metro station
	 *
	 * @since 1.0.0
	 */
	public ?string $nearest_metro_station = null;

	/**
	 * @var string|null $site Site
	 *
	 * @since 1.0.0
	 */
	public ?string $site = null;

	/**
	 * @var string|null $office_images_list Office images list
	 *
	 * @since 1.0.0
	 */
	public ?string $office_images_list = null;

	/**
	 * @var string|null $work_time_list Work time list
	 *
	 * @since 1.0.0
	 */
	public ?string $work_time_list = null;

	/**
	 * @var float|null $weight_min Minimum weight
	 *
	 * @since 1.0.0
	 */
	public ?float $weight_min = null;

	/**
	 * @var float|null $weight_max Maximum weight
	 *
	 * @since 1.0.0
	 */
	public ?float $weight_max = null;

	/**
	 * @var string|null $dimensions Dimensions
	 *
	 * @since 1.0.0
	 */
	public ?string $dimensions = null;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since 1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__wishboxcdek_offices', 'id', $db);
	}

	/**
	 * @param   integer       $cityCode    City code
	 * @param   boolean|null  $allowedCod  Разрешен наложенный платеж
	 * @param   array|null    $packages    Packages
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getItems(int $cityCode, ?bool $allowedCod = null, ?array $packages = null): array
	{
		$db = $this->getDbo();

		$query = $db->getQuery(true)
			->select(
				[
					'o.code',
					'CONCAT(o.address, " ", o.type, " ", o.weight_max) AS name',
					'o.type',
					'o.dimensions',
					'o.location_latitude',
					'o.location_longitude'
				]
			)
			->from('#__wishboxcdek_offices AS o')
			->where('o.city_code = ' . $cityCode);

		if ($allowedCod !== null)
		{
			$query->where('allowed_cod = ' . (int) $allowedCod);
		}

		if (is_array($packages) && count($packages))
		{
			$volumeWeight = $this->getVolumeWeight($packages);
			$query->where('(weight_max = 0 OR weight_max >= ' . $volumeWeight . ')');
		}

		$query->order('address');
		$db->setQuery($query);

		$list = $db->loadObjectList() ?: [];

		if (is_array($packages) && count($packages))
		{
			foreach ($list as $k => $item)
			{
				if ($item->type == 'POSTAMAT' && !empty($item->dimensions))
				{
					$deliveryPointDimensions = [];
					$itemDimensions          = json_decode($item->dimensions);

					if (!is_array($itemDimensions))
					{
						continue;
					}

					foreach ($itemDimensions as $itemDimension)
					{
						$arr = array_values((array) $itemDimension);
						rsort($arr);
						$deliveryPointDimensions[] = $arr;
					}

					$packageDimensions = [];

					foreach ($packages as $package)
					{
						$arr = [
							$package->width,
							$package->height,
							$package->length
						];
						rsort($arr);
						$packageDimensions[] = $arr;
					}

					$mainFlag = true;

					foreach ($packageDimensions as $packageDimension)
					{
						$flag = false;

						foreach ($deliveryPointDimensions as $deliveryPointDimension)
						{
							if ($packageDimension[0] < $deliveryPointDimension[0]
								&& $packageDimension[1] < $deliveryPointDimension[1]
								&& $packageDimension[2] < $deliveryPointDimension[2])
							{
								$flag = true;

								break;
							}
						}

						if (!$flag)
						{
							$mainFlag = false;
						}
					}

					if (!$mainFlag)
					{
						unset($list[$k]);
					}
				}
			}
		}

		return $list;
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
