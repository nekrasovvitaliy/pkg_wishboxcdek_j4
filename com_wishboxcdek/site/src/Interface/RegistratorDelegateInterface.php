<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Interface;

use Joomla\Component\Wishboxcdek\Site\Entity\ProductEntity;
use Joomla\Database\DatabaseDriver;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\PackageRequest as OrdersPostPackageRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\PackageRequest as OrdersPatchPackageRequest;

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
interface RegistratorDelegateInterface
{
	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getOrderNumber(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getOrderComment(): string;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getTariffCode(): int;

	/**
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryRecipientCost(): array;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getSellerName(): string;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getSellerInn(): int;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getSellerPhone(): string;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getSellerOwnershipForm(): int;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRecipientCompany(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRecipientName(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRecipientEmail(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRecipientPhone(): string;

	/**
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function isTariffFromDoor(): bool;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getTotalWeight(): int;

	/**
	 * @return OrdersPostPackageRequest[]
	 *
	 * @since 1.0.0
	 */
	public function getOrdersPostPackages(): array;

	/**
	 * @return OrdersPatchPackageRequest[]
	 *
	 * @since 1.0.0
	 */
	public function getOrdersPatchPackages(): array;

	/**
	 * @return ProductEntity[]
	 *
	 * @since 1.0.0
	 */
	public function getProducts(): array;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getShipmentPoint(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryPoint(): string;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCityCode(): int;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryAddress(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getSenderName(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getSenderPhoneNumber(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getSenderPhoneAdditional(): string;

	/**
	 * @param   string  $trackingNumber  Tracking number
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function setTrackingNumber(string $trackingNumber): void;

	/**
	 * @param   float  $shippingPriceTariff  Shipping price tariff
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function setShippingPriceTariff(float $shippingPriceTariff): void;
}
