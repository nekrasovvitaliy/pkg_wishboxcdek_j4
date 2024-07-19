<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Service\RequestCreator;

use Exception;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Site\Interface\RegistratorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\Contact\PhoneRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ContactRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\MoneyRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\SellerRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ToLocationRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatchRequest;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrdersPatchRequestCreator
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
	 * @return OrdersPatchRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getRequest(): OrdersPatchRequest
	{
		$ordersPatchRequest = new OrdersPatchRequest;
		$this->setOrderData($ordersPatchRequest);

		return $ordersPatchRequest;
	}

	/**
	 * @param   OrdersPatchRequest  $ordersPatchRequest  Order
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData(OrdersPatchRequest $ordersPatchRequest): void
	{
		$apiClient = $this->getApiClient();
		$orderNumber            = $this->delegate->getOrderNumber();
		$existingOrdersGetResponse = $apiClient->getOrderInfoByImNumber($orderNumber);

		$ordersPatchRequest->setUuid($existingOrdersGetResponse->getEntity()->getUuid());

		$orderComment           = $this->delegate->getOrderComment();
		$tariffCode             = $this->delegate->getTariffCode();
		$deliveryRecipientCost  = $this->delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $this->delegate->getShipmentPoint();

		$ordersPatchRequest->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost((new MoneyRequest)->setValue($deliveryRecipientCost['value']))
			->setShipmentPoint($shipmentPoint);

		if (WishboxcdekHelper::isTariffToPoint($tariffCode))
		{
			$deliveryPoint = $this->delegate->getDeliveryPoint();
			$ordersPatchRequest->setDeliveryPoint($deliveryPoint);
		}
		else
		{
			$cityCode = $this->delegate->getCityCode();
			$deliveryAddress = $this->delegate->getDeliveryAddress();
			$location = (new ToLocationRequest)
				->setAddress($deliveryAddress)
				->setCode($cityCode);
			$ordersPatchRequest->setToLocation($location);
		}

		$ordersPatchRequest->setPrint('waybill');

		$sellerName          = $this->delegate->getSellerName();
		$sellerInn           = $this->delegate->getSellerInn();
		$sellerPhone         = $this->delegate->getSellerPhone();
		$sellerOwnershipForm = $this->delegate->getSellerOwnershipForm();

		$seller = (new SellerRequest)
			->setName($sellerName)
			->setInn($sellerInn)
			->setPhone($sellerPhone)
			->setOwnershipForm($sellerOwnershipForm);
		$ordersPatchRequest->setSeller($seller);

		$recipientCompany   = $this->delegate->getRecipientCompany();
		$recipientName      = $this->delegate->getRecipientName();
		$recipientEmail     = $this->delegate->getRecipientEmail();
		$recipientPhone     = $this->delegate->getRecipientPhone();

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

		if ($this->delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$packages = $this->delegate->getOrdersPatchPackages();
		$ordersPatchRequest->setPackages($packages);
	}
}
