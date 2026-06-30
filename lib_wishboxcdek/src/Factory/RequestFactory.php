<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Factory;

use Exception;
use Joomla\CMS\Factory;
use Joomla\Component\WishboxCdek\Site\Helper\WishboxCdekHelper;
use WishboxCdek\CdekClient;
use WishboxCdek\Enum\OrderPrint;
use WishboxCdek\Enum\OrderType;
use WishboxCdek\Exception\HttpException;
use WishboxCdek\Request\Calculator\CalculateTariffListRequest;
use WishboxCdek\Request\Calculator\LocationDto;
use WishboxCdek\Request\Order\ContactDto;
use WishboxCdek\Request\Order\CreateOrderRequest;
use WishboxCdek\Request\Order\GetOrderByNumberRequest;
use WishboxCdek\Request\Order\PhoneDto;
use WishboxCdek\Request\Order\RequestToLocationDto;
use WishboxCdek\Request\Order\SellerDto;
use WishboxCdek\Request\Order\SenderContactDto;
use WishboxCdek\Request\Order\UpdateOrderRequest;
use WishboxCdekLibrary\Interface\CalculatorAdapterInterface;
use WishboxCdekLibrary\Interface\OrderRegistrationAdapterInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since        1.0.0
 *
 * @noinspection PhpUnused
 */
class RequestFactory implements RequestFactoryInterface
{
	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter
	 *
	 * @return UpdateOrderRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createUpdateOrderRequest(OrderRegistrationAdapterInterface $adapter): UpdateOrderRequest
	{
		$tariffCode = $adapter->getTariffCode();

		$orderNumber = $adapter->getOrderNumber();

		$packages = $adapter->getOrdersPatchPackages();

		$recipientCompany = $adapter->getRecipientCompany();
		$recipientName    = $adapter->getRecipientName();
		$recipientEmail   = $adapter->getRecipientEmail();
		$recipientPhone   = $adapter->getRecipientPhone();

		$recipient = ContactDto::make(
			name: $recipientName,
			phones: [
				$recipientPhone
			]
		)
			->withCompany($recipientCompany)
			->withEmail($recipientEmail);

		$sellerName          = $adapter->getSellerName();
		$sellerInn           = $adapter->getSellerInn();
		$sellerPhone         = $adapter->getSellerPhone();
		$sellerOwnershipForm = $adapter->getSellerOwnershipForm();

		$sellerDto = new SellerDto(
			name: $sellerName,
			inn: $sellerInn,
			phone: $sellerPhone,
			ownershipForm: $sellerOwnershipForm
		);

		$orderComment = $adapter->getOrderComment();
		$deliveryRecipientCost = $adapter->getDeliveryRecipientCost();
		$shipmentPoint         = $adapter->getShipmentPoint();

		$updateOrderRequest = UpdateOrderRequest::make(
			type: OrderType::INTERNET_SHOP,
			tariffCode: $tariffCode,
			recipient: $recipient,
			packages: $packages,

		)->withComment($orderComment);

		/** @var CdekClient $apiClient */
		$apiClient = Factory::getContainer()->get(CdekClient::class);

		try
		{
			$existingOrderDetails = $apiClient->orders()
				->getByNumber(
					new GetOrderByNumberRequest(imNumber: $orderNumber)
				);
			$uuid                 = $existingOrderDetails->entity->uuid;
		}
		catch (HttpException $e)
		{
			$uuid = $e->getResponse()['entity']['uuid'] ?? null;

			if (!$uuid)
			{
				throw $e;
			}
		}

		$updateOrderRequest = $updateOrderRequest->withUuid($uuid)
			->withDeliveryRecipientCost($deliveryRecipientCost)
			->withShipmentPoint($shipmentPoint);

		if (WishboxCdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $adapter->getDeliveryPoint();
			$updateOrderRequest = $updateOrderRequest->withDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode           = $adapter->getCityCode();
			$deliveryAddress    = $adapter->getDeliveryAddress();
			$toLocation         = new RequestToLocationDto(
				address: $deliveryAddress,
				code: $cityCode
			);
			$updateOrderRequest = $updateOrderRequest->withToLocation($toLocation);
		}

		$updateOrderRequest = $updateOrderRequest->withPrint(OrderPrint::WAYBILL)
			->withSeller($sellerDto);

		if ($adapter->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		return $updateOrderRequest;
	}

	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter
	 *
	 * @return CreateOrderRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createCreateOrderRequest(OrderRegistrationAdapterInterface $adapter): CreateOrderRequest
	{
		$orderNumber           = $adapter->getOrderNumber();
		$orderComment          = $adapter->getOrderComment();
		$tariffCode            = $adapter->getTariffCode();
		$deliveryRecipientCost = $adapter->getDeliveryRecipientCost();
		$shipmentPoint         = $adapter->getShipmentPoint();

		$senderName            = $adapter->getSenderName();
		$senderPhoneNumber     = $adapter->getSenderPhoneNumber();
		$senderPhoneAdditional = $adapter->getSenderPhoneAdditional();
		$senderPhones          = [
			new PhoneDto(
				number: $senderPhoneNumber,
				additional: !empty($senderPhoneAdditional) ? $senderPhoneAdditional : null,
			)
		];

		$recipientCompany = $adapter->getRecipientCompany();
		$recipientName    = $adapter->getRecipientName();
		$recipientEmail   = $adapter->getRecipientEmail();
		$recipientPhone   = $adapter->getRecipientPhone();

		// Добавление информации о продавце
		$sellerName          = $adapter->getSellerName();
		$sellerInn           = $adapter->getSellerInn();
		$sellerPhone         = $adapter->getSellerPhone();
		$sellerOwnershipForm = $adapter->getSellerOwnershipForm();

		$packages = $adapter->getOrdersPostPackages();

		$seller = new SellerDto(
			name: $sellerName,
			inn: $sellerInn,
			phone: $sellerPhone,
			ownershipForm: $sellerOwnershipForm
		);

		$ordersPostRequest = CreateOrderRequest::make(
			tariffCode: $tariffCode,
			sender: new SenderContactDto(
				name: $senderName,
				phones: $senderPhones,
			),
			recipient: new ContactDto(
				name: $recipientName,
				phones: [$recipientPhone],
				company: $recipientCompany,
				email: $recipientEmail,
			),
			packages: $packages,
		)
			->withNumber($orderNumber)
			->withType(OrderType::INTERNET_SHOP)
			->withComment($orderComment)
			->withDeliveryRecipientCost($deliveryRecipientCost)
			->withShipmentPoint($shipmentPoint);

		if (WishboxCdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint     = $adapter->getDeliveryPoint();
			$ordersPostRequest = $ordersPostRequest->withDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode          = $adapter->getCityCode();
			$deliveryAddress   = $adapter->getDeliveryAddress();
			$location          = new RequestToLocationDto(
				address: $deliveryAddress,
				code: $cityCode
			);
			$ordersPostRequest = $ordersPostRequest->withToLocation($location);
		}

		// Запрос создать файл накладной вместе с заказом
		$ordersPostRequest = $ordersPostRequest->withPrint(OrderPrint::WAYBILL)
			->withSeller($seller);

		if ($adapter->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		return $ordersPostRequest;
	}

	/**
	 * @param   CalculatorAdapterInterface  $adapter
	 *
	 * @return CalculateTariffListRequest
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	public function createCalculateTariffListRequest(CalculatorAdapterInterface $adapter): CalculateTariffListRequest
	{
		$senderCityCode   = $adapter->getSenderCityCode();
		$receiverCityCode = $adapter->getReceiverCityCode();
		$packages         = $adapter->getPackages();

		$tariffListPostRequest = new CalculateTariffListRequest(
			fromLocation: new LocationDto($senderCityCode),
			toLocation: new LocationDto($receiverCityCode),
			packages: $packages,
		);

		return $tariffListPostRequest;
	}
}
