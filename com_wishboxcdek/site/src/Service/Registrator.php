<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use Exception;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Site\Interface\RegistratorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Service\RequestCreator\OrdersPostRequestCreator;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use WishboxCdekSDK2\Exceptions\CdekV2AuthException;
use WishboxCdekSDK2\Exceptions\CdekV2RequestException;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPostRequest;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGetResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPostResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class Registrator
{
	use ApiClientTrait;

	/**
	 * @var RegistratorDelegateInterface $delegate
	 *
	 * @since 1.0.0
	 */
	protected RegistratorDelegateInterface $delegate;

	/**
	 * @param   RegistratorDelegateInterface  $delegate Delegate
	 *
	 * @since 1.0.0
	 */
	public function __construct(RegistratorDelegateInterface $delegate)
	{
		$this->delegate = $delegate;
	}

	/**
	 * Registers a new order or updates an existing one
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function register(): void
	{
		$apiClient = $this->getApiClient();

		$orderNumber = $this->delegate->getOrderNumber();

		if (!$this->isOrderExists($orderNumber))
		{
			$this->createOrder();
		}
		else
		{
			$this->updateOrder();
		}
	}

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function createOrder(): void
	{
		$ordersPostRequestCreator = new OrdersPostRequestCreator($this->delegate);
		$ordersPostRequest = $ordersPostRequestCreator->getRequest();
		$apiClient = $this->getApiClient();
		$ordersPostResponse = $apiClient->createOrder($ordersPostRequest);
		print_r($ordersPostResponse);
	}

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function updateOrder(): void
	{
		$ordersPostRequest = (new OrdersPostRequestCreator($this->delegate))->getRequest();
		$this->setOrderData($ordersPostRequest);
	}


//		$existingOrderResponse = $this->getExistingOrder($orderNumber);
//		$ordersPostRequest = new OrdersPostRequest;
//		$this->setOrderData($ordersPostRequest, $existingOrderResponse);
//
//		try
//		{
//			sleep(1);
//
//			if ($existingOrderResponse)
//			{
//				$entityResponse = $apiClient->updateOrder($order);
//			}
//			else
//			{
//				$ordersPostResponse = $apiClient->createOrder($ordersPostRequest);
//			}
//
//			$entityResponse->getEntityUuid();
//
//			sleep(1);
//			$orderResponse = $apiClient->getOrderInfoByImNumber($orderNumber);
//			$deliverySum = $orderResponse->getDeliveryDetail()->getDeliverySum();
//
//			$this->delegate->setShippingPriceTariff($deliverySum);
//			$this->delegate->setTrackingNumber($orderResponse->getCdekNumber());
//
//			$orderUuid = $orderResponse->getUuid();
//
//			$order->setUuid($orderUuid);
//			$deliveryRecipientCost = $this->delegate->getDeliveryRecipientCost();
//			$order->setDeliveryRecipientCost($deliveryRecipientCost['value'], 0);
//			$order->getPackages()[0]->setPackageId(
//				$orderResponse->getPackages()[0]->getPackageId()
//			);
//			$apiClient->updateOrder($order);
//		}
//		catch (CdekV2RequestException $e)
//		{
//			if ($e->errorCode == 'v2_entity_invalid')
//			{
//				$invalidEntityUuid = str_replace('Entity is invalid ', '', $e->errorMessage);
//
//				try
//				{
//					$apiClient->deleteOrder($invalidEntityUuid);
//				}
//				catch (CdekV2RequestException $e)
//				{
//					echo $e;
//					die;
//				}
//			}
//
//			throw $e;
//		}
//	}

	/**
	 * @param   string  $orderNumber  Order number
	 *
	 * @return OrdersGetResponse|null
	 *
	 * @throws CdekV2AuthException
	 * @throws CdekV2RequestException
	 *
	 * @since 1.0.0
	 */
	protected function getExistingOrder(string $orderNumber): ?OrdersGetResponse
	{
		$apiClient = $this->getApiClient();

		try
		{
			sleep(1);

			return $apiClient->getOrderInfoByImNumber($orderNumber);
		}
		catch (CdekV2RequestException $e)
		{
			if ($e->errorCode == 'v2_entity_not_found_im_number')
			{
				return null;
			}
			// Perhaps $e->errorCode is equal 'error_validate_receiver_phone_number_incorrect'
			else
			{
				sleep(1);

				try
				{
					$existingOrderResponse = $apiClient->getOrderInfoByImNumber($orderNumber, false);
				}
				catch (CdekV2RequestException $e)
				{
					echo $e;

					die;
				}

				$orderStatuses = $existingOrderResponse->getStatuses();
				$orderStatusCodes = [];

				foreach ($orderStatuses as $orderStatusResponce)
				{
					/** \AntistressStore\CdekSDK2\Entity\Responses\StatusResponse $orderStatusResponce */
					$orderStatusCodes[] = $orderStatusResponce->getCode();
				}

				if (in_array('CREATED', $orderStatusCodes))
				{
					return $existingOrderResponse;
				}
				else
				{
					return null;
				}
			}
		}
	}

	/**
	 * @param   string  $orderNumber  Order number
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	protected function isOrderExists(string $orderNumber): bool
	{
		$apiClient = $this->getApiClient();

		$ordersGetResponse = $apiClient->getOrderInfoByImNumber($orderNumber, false);

		if (!$ordersGetResponse->getEntity())
		{
			return false;
		}

		return true;
	}

	/**
	 * @param   OrdersPostRequest   $ordersPostRequest      Order
	 * @param   OrderResponse|null  $existingOrderResponse  Existing Order response
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData(OrdersPostRequest $ordersPostRequest): void
	{
		if ($existingOrderResponse)
		{
			$ordersPostRequest->setUuid($existingOrderResponse->getUuid());
		}

		$orderNumber            = $this->delegate->getOrderNumber();
		$orderComment           = $this->delegate->getOrderComment();
		$tariffCode             = $this->delegate->getTariffCode();
		$deliveryRecipientCost  = $this->delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $this->delegate->getShipmentPoint();

		$ordersPostRequest->setNumber($orderNumber)
			->setType(1)
			->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost($deliveryRecipientCost['value'], 0)
			->setShipmentPoint($shipmentPoint);

		if (WishboxcdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $this->delegate->getDeliveryPoint();
			$ordersPostRequest->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $this->delegate->getCityCode();
			$deliveryAddress = $this->delegate->getDeliveryAddress();
			$location = (new Location)
				->setAddress($deliveryAddress)
				->setCode($cityCode);
			$ordersPostRequest->setToLocation($location);
		}

		// Запрос создать файл накладной вместе с заказом
		$ordersPostRequest->setPrint('waybill');

		// Добавление информации о продавце
		$sellerName          = $this->delegate->getSellerName();
		$sellerInn           = $this->delegate->getSellerInn();
		$sellerPhone         = $this->delegate->getSellerPhone();
		$sellerOwnershipForm = $this->delegate->getSellerOwnershipForm();

		$seller = (new Seller)
			->setName($sellerName)
			->setInn($sellerInn)
			->setPhone($sellerPhone)
			->setOwnershipForm($sellerOwnershipForm);
		$ordersPostRequest->setSeller($seller);

		$recipientCompany   = $this->delegate->getRecipientCompany();
		$recipientName      = $this->delegate->getRecipientName();
		$recipientEmail     = $this->delegate->getRecipientEmail();
		$recipientPhone     = $this->delegate->getRecipientPhone();

		// Добавление информации о получателе

		$recipient = (new Contact)
			->setCompany($recipientCompany)
			->setName($recipientName)
			->setEmail($recipientEmail)
			->setPhones($recipientPhone);

		$ordersPostRequest->setRecipient($recipient);

		if ($this->delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$totalWeight   = $this->delegate->getTotalWeight();
		$packageWidth  = $this->delegate->getPackageWidth();
		$packageHeight = $this->delegate->getPackageHeight();
		$packageLength = $this->delegate->getPackageLength();

		// Создаем данные посылки. Место
		$package = new Package;

		if ($existingOrderResponse)
		{
			$existingPackages = $existingOrderResponse->getPackages();

			/** @var PackagesResponse $package */
			$existingPackage   = $existingPackages[0];
			$existingPackageId = $existingPackage->getPackageId();
			$package->setPackageId($existingPackageId);
		}

		$package->setNumber('1')
			->setWeight($totalWeight)
			->setHeight($packageHeight)
			->setWidth($packageWidth)
			->setLength($packageLength);

		$products = $this->delegate->getProducts();

		// Создаем товары
		$items = [];

		foreach ($products as $product)
		{
			$items[] = (new Item)
				->setName($product->name)
				->setWareKey($product->code)
				// Оплата за товар при получении, без НДС (за единицу товара)
				->setPayment($product->payment)
				// Объявленная стоимость товара (за единицу товара)
				->setCost($product->cost)
				// Вес в граммах
				->setWeight($product->weight)
				// Количество
				->setAmount($product->quantity);
		}

		$package->setItems($items);
		$ordersPostRequest->setPackages($package);
	}

	/**
	 * @param   OrdersPostRequest   $ordersPostRequest      Order
	 * @param   OrderResponse|null  $existingOrderResponse  Existing Order response
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData2(OrdersPostRequest $ordersPostRequest, ?OrderResponse $existingOrderResponse = null): void
	{
		if ($existingOrderResponse)
		{
			$ordersPostRequest->setUuid($existingOrderResponse->getUuid());
		}

		$orderNumber            = $this->delegate->getOrderNumber();
		$orderComment           = $this->delegate->getOrderComment();
		$tariffCode             = $this->delegate->getTariffCode();
		$deliveryRecipientCost  = $this->delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $this->delegate->getShipmentPoint();

		$ordersPostRequest->setNumber($orderNumber)
			->setType(1)
			->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost($deliveryRecipientCost['value'], 0)
			->setShipmentPoint($shipmentPoint);

		if (WishboxcdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $this->delegate->getDeliveryPoint();
			$ordersPostRequest->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $this->delegate->getCityCode();
			$deliveryAddress = $this->delegate->getDeliveryAddress();
			$location = (new Location)
				->setAddress($deliveryAddress)
				->setCode($cityCode);
			$ordersPostRequest->setToLocation($location);
		}

		// Запрос создать файл накладной вместе с заказом
		$ordersPostRequest->setPrint('waybill');

		// Добавление информации о продавце
		$sellerName          = $this->delegate->getSellerName();
		$sellerInn           = $this->delegate->getSellerInn();
		$sellerPhone         = $this->delegate->getSellerPhone();
		$sellerOwnershipForm = $this->delegate->getSellerOwnershipForm();

		$seller = (new Seller)
			->setName($sellerName)
			->setInn($sellerInn)
			->setPhone($sellerPhone)
			->setOwnershipForm($sellerOwnershipForm);
		$ordersPostRequest->setSeller($seller);

		$recipientCompany   = $this->delegate->getRecipientCompany();
		$recipientName      = $this->delegate->getRecipientName();
		$recipientEmail     = $this->delegate->getRecipientEmail();
		$recipientPhone     = $this->delegate->getRecipientPhone();

		// Добавление информации о получателе

		$recipient = (new Contact)
			->setCompany($recipientCompany)
			->setName($recipientName)
			->setEmail($recipientEmail)
			->setPhones($recipientPhone);

		$ordersPostRequest->setRecipient($recipient);

		if ($this->delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$totalWeight   = $this->delegate->getTotalWeight();
		$packageWidth  = $this->delegate->getPackageWidth();
		$packageHeight = $this->delegate->getPackageHeight();
		$packageLength = $this->delegate->getPackageLength();

		// Создаем данные посылки. Место
		$package = new Package;

		if ($existingOrderResponse)
		{
			$existingPackages = $existingOrderResponse->getPackages();

			/** @var PackagesResponse $package */
			$existingPackage   = $existingPackages[0];
			$existingPackageId = $existingPackage->getPackageId();
			$package->setPackageId($existingPackageId);
		}

		$package->setNumber('1')
			->setWeight($totalWeight)
			->setHeight($packageHeight)
			->setWidth($packageWidth)
			->setLength($packageLength);

		$products = $this->delegate->getProducts();

		// Создаем товары
		$items = [];

		foreach ($products as $product)
		{
			$items[] = (new Item)
				->setName($product->name)
				->setWareKey($product->code)
				// Оплата за товар при получении, без НДС (за единицу товара)
				->setPayment($product->payment)
				// Объявленная стоимость товара (за единицу товара)
				->setCost($product->cost)
				// Вес в граммах
				->setWeight($product->weight)
				// Количество
				->setAmount($product->quantity);
		}

		$package->setItems($items);
		$ordersPostRequest->setPackages($package);
	}
}
