<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Table;

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @package     Joomla\Component\Jshopping\Site\Table
 *
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
	public ?string $code;

	/**
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	public ?string $addres;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since 1.0.0
	 */
	public function __construct(&$db)
	{
		parent::__construct($db->qn('#__wishboxcdek_offices'), 'id', $db);
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
		$db = Factory::getContainer()->get(DatabaseDriver::class);

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

		if ($allowedCod)
		{
			$query->where('allowed_cod = ' . (int) $allowedCod);
		}

		if (is_array($packages) && count($packages))
		{
			$volumeWeight = $this->getVolumeWeight($packages);
			$query->where('weight_max >= ' . $volumeWeight);
		}

		$query->order('address');
		$db->setQuery($query);

		$list = $db->loadObjectList();

		if (is_array($packages) && count($packages))
		{
			foreach ($list as $k => $item)
			{
				if ($item->type == 'POSTAMAT' && !empty($item->dimensions))
				{
					$deliveryPointDimensions = [];
					$itemDimensions          = json_decode($item->dimensions);

					foreach ($itemDimensions as $itemDimension)
					{
						$arr = array_values((array) $itemDimension);
						arsort($arr);
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
						arsort($arr);
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
