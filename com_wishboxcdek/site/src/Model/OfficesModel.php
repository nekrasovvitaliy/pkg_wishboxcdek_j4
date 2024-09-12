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
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Wishboxcdek\Site\Model\Offices\DataInterface;
use Wishbox\ShippingService\ShippingTariff;

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
	 * @param   array                 $config   An array of configuration options (name, state, dbo, table_path, ignore_request).
	 * @param   ?MVCFactoryInterface  $factory  The factory.
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function __construct($config = [], MVCFactoryInterface $factory = null)
	{
		parent::__construct($config, $factory);

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
		$this->setState('filter.city_code', $cityCode);

		$shippingMethodId = $app->getInput()->getInt('shipping_method_id');
		$this->setState('shipping_method_id', $shippingMethodId);

		$shippingTariffData = $app->getInput()->getVar('shipping_tariff');
		$this->setState('shipping_tariff_data', $shippingTariffData);

		$packagesData = $app->getInput()->getVar('packages_data');
		$this->setState('filter.packages_data', $packagesData);

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
			$shippingTariffData = json_decode($this->getState('shipping_tariff_data'), true);
			$shippingTariff = ShippingTariff::withArray($shippingTariffData);

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

				$feature['options']['preset'] = 'islands#greenIcon';

				$feature['properties'] = [];
				$feature['properties']['balloonContent'] = LayoutHelper::render(
					'components.wishboxcdek.changeoffice/yandexmap/balooncontent.d',
					[
						'office'                => $item,
						'shipping_tariff'       => $shippingTariff,
						'adv_user'              => $this->advUser,
						'shipping_method_id'    => $shippingMethodId
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
		$cityCode = $this->getState('filter.city_code');

		if ($cityCode == 0)
		{
			throw new InvalidArgumentException('param $cityCode must be more than zero', 500);
		}

		$allowedCod = $this->getState('filter.allowed_cod');
		$packagesData = $this->getState('filter.packages_data');
		$packages = json_decode($packagesData);

		return $this->dataModel->getOffices($cityCode, $allowedCod, $packages);
	}
}
