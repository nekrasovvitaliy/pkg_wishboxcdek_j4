<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Site\Model\Offices\DataInterface;
use Wishbox\ShippingService\Cdek\Dimensions;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class OfficesModel extends BaseDatabaseModel
{
	/**
	 * @var DataInterface $wishboxcdekofficesdata Data
	 *
	 * @since 1.0.0
	 */
	protected DataInterface $dataModel;

	/**
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		parent::__construct();

		$app = Factory::getApplication();

		$componentParams = ComponentHelper::getParams('com_wishboxcdek');
		$officeListType = $componentParams->get('office_list_type', 'city');

		$this->dataModel = $app->bootComponent('com_wishboxcdek')
			->createModel(
				'data' . $officeListType,
				'Site\\Model\\Offices'
			);
	}

	/**
	 * Method to autopopulate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	protected function populateState()
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$cityCode = $app->getInput()->getInt('city_code');
		$this->setState('filter.cityCode', $cityCode);

		$shippingMethodId = $app->getInput()->getInt('shipping_method_id');
		$this->setState('shipping_method_id', $shippingMethodId);

		$shopName = $app->getInput()->get('shop_name');
		$this->setState('shop_name', $shopName);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * @param   string|null   $shopName          Shop name
	 * @param   integer|null  $shippingMethodId  Shipping method id
	 *
	 * @return   array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getMapData(
		?string $shopName = null,
		?int $shippingMethodId = 0
	): array
	{
		$shopName = $shopName ?: $this->getState('shop_name');

		if (empty($shopName))
		{
			throw new InvalidArgumentException('param $shopName must not be empty', 500);
		}

		$shippingMethodId = (int) ($shippingMethodId ?: $this->getState('shipping_method_id'));

		if ($shippingMethodId == 0)
		{
			throw new InvalidArgumentException('param $shippingMethodId must be more than zero', 500);
		}

		$data = [];
		$data['type'] = 'FeatureCollection';
		$data['features'] = [];
		$items = $this->getItems();

		if (count($items))
		{
			$shippingTariff = WishboxcdekHelper::getShippingTariff($shopName, $shippingMethodId);

			foreach ($items as $item)
			{
				$feature = [];
				$feature['type'] = 'Feature';
				$feature['id'] = $item->code;
				$feature['geometry'] = [
					'type'          => 'Point',
					'coordinates'   => [
						$item->location_latitude, // phpcs:ignore
						$item->location_longitude // phpcs:ignore
					]
				];
				$feature['options'] = [];
				$feature['options']['iconLayout'] = 'default#image';
				$feature['properties'] = [];
				$feature['properties']['iconLayout'] = 'default#image';
				$feature['properties']['balloonContent'] = LayoutHelper::render(
					'components.wishboxcdek.changeoffice/yandexmap/balooncontent.d',
					[
						'office'            => $item,
						'shippingTariff'    => $shippingTariff,
						'advUser'           => $this->advUser,
						'shippingMethodId'  => $shippingMethodId
					]
				);
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
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getItems(): array
	{
		$cityCode = $this->getState('filter.cityCode');

		if ($cityCode == 0)
		{
			throw new InvalidArgumentException('param $cityCode must be more than zero', 500);
		}

		return $this->dataModel->getOffices($cityCode, [new Dimensions(1000, 900, 800)]);
	}
}
