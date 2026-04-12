<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Administrator\Factory;

use Exception;
use Joomla\Component\WishboxCdek\Site\Helper\WishboxCdekHelper;
use Joomla\Component\WishboxCdek\Site\Interface\CalculatorDelegateInterface;
use Joomla\Component\WishboxCdek\Site\Interface\RegistratorDelegateInterface;
use WishboxCdekSDK2\Exception\Api\RequestErrorException;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareInterface;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareTrait;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPostRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\Contact\PhoneRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ContactRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\MoneyRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\SellerRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ToLocationRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatchRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPostRequest;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class RequestFactory implements RequestFactoryInterface, CdekClientV2FactoryAwareInterface
{
	use CdekClientV2FactoryAwareTrait;

	/**
	 * @param   RegistratorDelegateInterface  $delegate
	 *
	 * @return OrdersPatchRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createOrdersPatchRequest(RegistratorDelegateInterface $delegate): OrdersPatchRequest
	{
		$ordersPatchRequest = new OrdersPatchRequest;

		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();
		$orderNumber = $delegate->getOrderNumber();

		try
		{
			$existingOrdersGetResponse = $apiClient->getOrderInfoByImNumber($orderNumber);
			$uuid = $existingOrdersGetResponse->getEntity()->getUuid();
		}
		catch (RequestErrorException $e)
		{
			$data = json_decode($e->getResponseData()->getBody());
			$uuid = $data->entity->uuid;
		}

		$ordersPatchRequest->setUuid($uuid);

		$orderComment           = $delegate->getOrderComment();
		$tariffCode             = $delegate->getTariffCode();
		$deliveryRecipientCost  = $delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $delegate->getShipmentPoint();

		$ordersPatchRequest->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost((new MoneyRequest)->setValue($deliveryRecipientCost['value']))
			->setShipmentPoint($shipmentPoint);

		if (WishboxCdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $delegate->getDeliveryPoint();
			$ordersPatchRequest->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $delegate->getCityCode();
			$deliveryAddress = $delegate->getDeliveryAddress();
			$location = (new ToLocationRequest)
				->setAddress($deliveryAddress)
				->setCode($cityCode);
			$ordersPatchRequest->setToLocation($location);
		}

		$ordersPatchRequest->setPrint('waybill');

		$sellerName          = $delegate->getSellerName();
		$sellerInn           = $delegate->getSellerInn();
		$sellerPhone         = $delegate->getSellerPhone();
		$sellerOwnershipForm = $delegate->getSellerOwnershipForm();

		$seller = (new SellerRequest)
			->setName($sellerName)
			->setInn($sellerInn)
			->setPhone($sellerPhone)
			->setOwnershipForm($sellerOwnershipForm);
		$ordersPatchRequest->setSeller($seller);

		$recipientCompany   = $delegate->getRecipientCompany();
		$recipientName      = $delegate->getRecipientName();
		$recipientEmail     = $delegate->getRecipientEmail();
		$recipientPhone     = $delegate->getRecipientPhone();

		$recipient = (new ContactRequest)
			->setCompany($recipientCompany)
			->setName($recipientName)
			->setEmail($recipientEmail)
			->setPhones(
				[
					(new PhoneRequest)->setNumber($recipientPhone)
				]
			);

		$ordersPatchRequest->setRecipient($recipient);

		if ($delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$packages = $delegate->getOrdersPatchPackages();
		$ordersPatchRequest->setPackages($packages);

		return $ordersPatchRequest;
	}

	/**
	 * @param   RegistratorDelegateInterface  $delegate
	 *
	 * @return OrdersPostRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createOrdersPostRequest(RegistratorDelegateInterface $delegate): OrdersPostRequest
	{
		$ordersPostRequest      = new OrdersPostRequest;
		$orderNumber            = $delegate->getOrderNumber();
		$orderComment           = $delegate->getOrderComment();
		$tariffCode             = $delegate->getTariffCode();
		$deliveryRecipientCost  = $delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $delegate->getShipmentPoint();

		$ordersPostRequest->setNumber($orderNumber)
			->setType(1)
			->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost((new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\MoneyRequest)->setValue($deliveryRecipientCost['value']));

		$senderName = $delegate->getSenderName();
		$senderPhoneNumber = $delegate->getSenderPhoneNumber();
		$senderPhoneAdditional = $delegate->getSenderPhoneAdditional();
		$senderPhones = ['number' => $senderPhoneNumber];

		if (!empty($senderPhoneAdditional))
		{
			$senderPhones['additional'] = $senderPhoneAdditional;
		}

		$sender = (new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\ContactRequest)
			->setName($senderName)
			->setPhones($senderPhones);
		$ordersPostRequest->setSender($sender);

		$ordersPostRequest->setShipmentPoint($shipmentPoint);

		if (WishboxCdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $delegate->getDeliveryPoint();
			$ordersPostRequest->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $delegate->getCityCode();
			$deliveryAddress = $delegate->getDeliveryAddress();
			$location = (new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\ToLocationRequest)
				->setAddress($deliveryAddress)
				->setCode($cityCode);
			$ordersPostRequest->setToLocation($location);
		}

		// Запрос создать файл накладной вместе с заказом
		$ordersPostRequest->setPrint('waybill');

		// Добавление информации о продавце
		$sellerName          = $delegate->getSellerName();
		$sellerInn           = $delegate->getSellerInn();
		$sellerPhone         = $delegate->getSellerPhone();
		$sellerOwnershipForm = $delegate->getSellerOwnershipForm();

		$seller = (new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\SellerRequest)
			->setName($sellerName)
			->setInn($sellerInn)
			->setPhone($sellerPhone)
			->setOwnershipForm($sellerOwnershipForm);
		$ordersPostRequest->setSeller($seller);

		$recipientCompany   = $delegate->getRecipientCompany();
		$recipientName      = $delegate->getRecipientName();
		$recipientEmail     = $delegate->getRecipientEmail();
		$recipientPhone     = $delegate->getRecipientPhone();

		// Добавление информации о получателе
		$recipient = (new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\ContactRequest)
			->setCompany($recipientCompany)
			->setName($recipientName)
			->setEmail($recipientEmail)
			->setPhones(
				[
					(new \WishboxCdekSDK2\Model\Request\Orders\OrdersPost\Contact\PhoneRequest)->setNumber($recipientPhone)
				]
			);

		$ordersPostRequest->setRecipient($recipient);

		if ($delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$packages = $delegate->getOrdersPostPackages();
		$ordersPostRequest->setPackages($packages);

		return $ordersPostRequest;
	}

	/**
	 * @param   CalculatorDelegateInterface  $delegate
	 *
	 * @return TariffListPostRequest
	 *
	 * @since 1.0.0
	 */
	public function createTariffListPostRequest(CalculatorDelegateInterface $delegate): TariffListPostRequest
	{
		$tariffListPostRequest = new TariffListPostRequest;

		$weight = $delegate->getTotalWeight();
		$senderCityCode = $delegate->getSenderCityCode();
		$receiverCityCode = $delegate->getReceiverCityCode();
		$tariffListPostRequest->setCityCodes($senderCityCode, $receiverCityCode);
		$tariffListPostRequest->setPackageWeight($weight);

		$packages = $delegate->getPackages();
		$tariffListPostRequest->setPackages($packages);

		return $tariffListPostRequest;
	}
}
