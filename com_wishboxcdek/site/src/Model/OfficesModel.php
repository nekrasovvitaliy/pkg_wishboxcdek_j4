<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek;

use InvalidArgumentException;
use Joomla\CMS\Layout\FileLayout;
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Model\Wishbox\Shippingcalculator\CdekModel;
use Joomla\Registry\Registry;
use Wishbox\JShopping\Model\Base;
use Wishbox\ShippingService\Cdek\Dimensions;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property Registry  $addonParams
 * @property mixed     $advUser
 *
 * @since 1.0.0
 */
class OfficesModel extends Base
{
	/**
	 * @var string $addonAlias Addon alias
	 *
	 * @since 1.0.0
	 */
	protected string $addonAlias = 'wishboxcdek';

	/**
	 * @var Offices\DataInterface $wishboxcdekofficesdata Data
	 *
	 * @since 1.0.0
	 */
	protected Offices\DataInterface $wishboxcdekofficesdata;

	/**
	 * @since 1.0.0
	 */
	public function __construct()
	{
		parent::__construct();

		$this->wishboxcdekofficesdata = JSFactory::getModel(
			'data' . $this->addonParams->get('office_list_type', 'city'),
			'Site\\Wishbox\\Cdek\\Offices'
		);
	}


	/**
	 * Method
	 *
	 * @param   integer  $cityId        City id
	 * @param   integer  $shPrMethodId  Shipping price method id
	 *
	 * @return   array
	 *
	 * @since 1.0.0
	 */
	public function getOfficesDataForMap(int $cityId, int $shPrMethodId = 0): array
	{
		if ($shPrMethodId == 0)
		{
			throw new InvalidArgumentException('param $sh_pr_method_id must be more than zero', 500);
		}

		$data = [];
		$data['type'] = 'FeatureCollection';
		$data['features'] = [];
		$offices = $this->getOffices($cityId);

		if (count($offices))
		{
			/** @var CdekModel $wishboxshippingcalculatorcdekModel */
			$wishboxshippingcalculatorcdekModel = JSFactory::getModel('cdek', 'Site\\Wishbox\\Shippingcalculator');

			$shippingTariff = $wishboxshippingcalculatorcdekModel->getTariff($shPrMethodId);

			foreach ($offices as $item)
			{
				$feature = [];
				$feature['type'] = 'Feature';
				$feature['id'] = $item->code;
				$feature['geometry'] = [
					'type' => 'Point',
					'coordinates' => [
						$item->location_latitude, // phpcs:ignore
						$item->location_longitude // phpcs:ignore
					]
				];
				$feature['options'] = [];
				$feature['options']['iconLayout'] = 'default#image';
				$feature['properties'] = [];
				$feature['properties']['iconLayout'] = 'default#image';
				$layoutPaths = [
					JPATH_SITE . '/components/com_jshopping/addons/wishboxcdek/layouts/wishboxcdekchangeoffice/yandexmap/balooncontent'
				];
				$renderer = new FileLayout('d');
				$renderer->setIncludePaths($layoutPaths);

				// Data array
				$displayData = [
					'office' => $item,
					'shipping_tariff' => $shippingTariff,
					'adv_user' => $this->advUser,
					'sh_pr_method_id' => $shPrMethodId
				];
				$feature['properties']['balloonContent'] = $renderer->render($displayData);
				$feature['properties']['clusterCaption'] = 'hj-';
				$feature['properties']['hintContent'] = '<strong>' . $item->code . '</strong>';
				$feature['properties']['shipping_service'] = 'Сдек';
				$types = [
					'PVZ' => 'Пункты выдачи заказов',
					'POSTAMAT' => 'Постаматы'
				];
				$feature['properties']['point_type'] = $types[$item->type];
				$data['features'][] = $feature;
			}
		}

		return $data;
	}

	/**
	 * @param   integer  $cityCode  City code
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode): array
	{
		return $this->wishboxcdekofficesdata->getOffices($cityCode, [new Dimensions(1000, 900, 800)]);
	}
}
