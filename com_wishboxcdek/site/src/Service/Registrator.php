<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use AntistressStore\CdekSDK2\Entity\Requests\Contact;
use AntistressStore\CdekSDK2\Entity\Requests\Item;
use AntistressStore\CdekSDK2\Entity\Requests\Location;
use AntistressStore\CdekSDK2\Entity\Requests\Order;
use AntistressStore\CdekSDK2\Entity\Requests\Package;
use AntistressStore\CdekSDK2\Entity\Requests\Seller;
use AntistressStore\CdekSDK2\Entity\Responses\OrderResponse;
use AntistressStore\CdekSDK2\Entity\Responses\PackagesResponse;
use AntistressStore\CdekSDK2\Exceptions\CdekV2RequestException;
use Exception;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Site\Interface\RegistratorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

require_once JPATH_SITE . '/vendor/autoload.php';

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
		$existingOrderResponse = $this->getExistingOrder($orderNumber);
		$order = new Order;
		$this->setOrderData($order, $existingOrderResponse);

		try
		{
			sleep(1);

			if ($existingOrderResponse)
			{
				$entityResponse = $apiClient->updateOrder($order);
			}
			else
			{
				$entityResponse = $apiClient->createOrder($order);
			}

			$entityResponse->getEntityUuid();

			sleep(1);
			$orderResponse = $apiClient->getOrderInfoByImNumber($orderNumber);
			$deliverySum = $orderResponse->getDeliveryDetail()->getDeliverySum();

			$this->delegate->setShippingPriceTariff($deliverySum);
			$this->delegate->setTrackingNumber($orderResponse->getCdekNumber());

			$order->setDeliveryRecipientCost($this->delegate->getDeliveryRecipientCost()['value'], 0);
			$apiClient->updateOrder($order);
		}
		catch (CdekV2RequestException $e)
		{
			if ($e->errorCode == 'v2_entity_invalid')
			{
				$invalidEntityUuid = str_replace('Entity is invalid ', '', $e->errorMessage);

				try
				{
					$apiClient->deleteOrder($invalidEntityUuid);
				}
				catch (CdekV2RequestException $e)
				{
					echo $e;
					die;
				}
			}

			throw $e;
		}
	}

	/**
	 * @param   string  $orderNumber  Order number
	 *
	 * @return OrderResponse|null
	 *
	 * @since 1.0.0
	 */
	protected function getExistingOrder(string $orderNumber): ?OrderResponse
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
	 * @param   Order               $order                  Order
	 * @param   OrderResponse|null  $existingOrderResponse  Existing Order response
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData(Order $order, ?OrderResponse $existingOrderResponse = null): void
	{
		if ($existingOrderResponse)
		{
			$order->setUuid($existingOrderResponse->getUuid());
		}

		$orderNumber            = $this->delegate->getOrderNumber();
		$orderComment           = $this->delegate->getOrderComment();
		$tariffCode             = $this->delegate->getTariffCode();
		$deliveryRecipientCost  = $this->delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $this->delegate->getShipmentPoint();

		$order->setNumber($orderNumber)
			->setType(1)
			->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost($deliveryRecipientCost['value'], 0)
			->setShipmentPoint($shipmentPoint);

		if (WishboxcdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $this->delegate->getDeliveryPoint();
			$order->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $this->delegate->getCityCode();
			$deliveryAddress = $this->delegate->getDeliveryAddress();
			$location = (new Location)->setAddress($deliveryAddress)
				->setCode($cityCode);
			$order->setToLocation($location);
		}

		// Запрос создать файл накладной вместе с заказом
		$order->setPrint('waybill');

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
		$order->setSeller($seller);

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

		$order->setRecipient($recipient);

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
			$existingPackage = $existingPackages[0];
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

		foreach ($products as  $product)
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
		$order->setPackages($package);
	}
}
