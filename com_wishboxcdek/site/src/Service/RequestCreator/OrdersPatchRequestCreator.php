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
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\Package\ItemRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\PackageRequest;
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
		$existingOrdersGetResponse = $apiClient->getOrderInfoByImNumber($orderNumber, false);

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

		// Запрос создать файл накладной вместе с заказом
		$ordersPatchRequest->setPrint('waybill');

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
		$ordersPatchRequest->setSeller($seller);

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

		$ordersPatchRequest->setRecipient($recipient);

		if ($this->delegate->isTariffFromDoor())
		{
			throw new Exception('', 500);
		}

		$totalWeight   = $this->delegate->getTotalWeight();
		$packageWidth  = $this->delegate->getPackageWidth();
		$packageHeight = $this->delegate->getPackageHeight();
		$packageLength = $this->delegate->getPackageLength();

		// Создаем данные посылки. Место
		$package = new PackageRequest;

		$existingPackages = $existingOrdersGetResponse->getEntity()->getPackages();

		$existingPackage   = $existingPackages[0];
		$existingPackageId = $existingPackage->getPackageId();
		$package->setPackageId($existingPackageId);

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
			$items[] = (new ItemRequest)
				->setName($product->name)
				->setWareKey($product->code)
				->setPayment((new MoneyRequest)->setValue($product->payment))
				->setCost($product->cost)
				->setWeight($product->weight)
				->setAmount($product->quantity);
		}

		$package->setItems($items);
		$ordersPatchRequest->setPackages([$package]);
	}
}
