<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrsov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service\RequestCreator;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Site\Interface\RegistratorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\Contact\PhoneRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\ContactRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\MoneyRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\PackageRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\SellerRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\ToLocationRequest;
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
class OrdersPostRequestCreator
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
	 * @return OrdersPostRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getRequest(): OrdersPostRequest
	{
		$ordersPostRequest = new OrdersPostRequest;
		$this->setOrderData($ordersPostRequest);

		return $ordersPostRequest;
	}

	/**
	 * @param   OrdersPostRequest   $ordersPostRequest      Order
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData(OrdersPostRequest $ordersPostRequest): void
	{
		$orderNumber            = $this->delegate->getOrderNumber();
		$orderComment           = $this->delegate->getOrderComment();
		$tariffCode             = $this->delegate->getTariffCode();
		$deliveryRecipientCost  = $this->delegate->getDeliveryRecipientCost();
		$shipmentPoint          = $this->delegate->getShipmentPoint();

		$ordersPostRequest->setNumber($orderNumber)
			->setType(1)
			->setComment($orderComment)
			->setTariffCode($tariffCode)
			->setDeliveryRecipientCost((new MoneyRequest)->setValue($deliveryRecipientCost['value']))
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
			$location = (new ToLocationRequest)
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

		$seller = (new SellerRequest)
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
		$recipient = (new ContactRequest)
			->setCompany($recipientCompany)
			->setName($recipientName)
			->setEmail($recipientEmail)
			->setPhones(
				[
					(new PhoneRequest)->setNumber($recipientPhone)
				]
			);

		$ordersPostRequest->setRecipient($recipient);

		if ($this->delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$packages = $this->delegate->getOrdersPostPackages();
		$ordersPostRequest->setPackages($packages);
	}
}
