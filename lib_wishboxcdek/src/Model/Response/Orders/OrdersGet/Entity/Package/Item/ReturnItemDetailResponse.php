<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Package\Item;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class ReturnItemDetailResponse extends AbstractResponse
{
	/**
	 * 1.26.10.16.1. Номер прямого заказа
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public string $direct_order_number; // phpcs:ignore

	/**
	 * 1.26.10.16.2. UUID прямого заказа
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public string $direct_order_uuid; // phpcs:ignore

	/**
	 * 1.26.10.16.3. Номер упаковки товара в прямом заказе
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public string $direct_package_number; // phpcs:ignore

	/**
	 * 1.26.10.16.1. Номер прямого заказа
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDirectOrderNumber(): string
	{
		return $this->direct_order_number; // phpcs:ignore
	}

	/**
	 * 1.26.10.16.2. UUID прямого заказа
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDirectOrderUuid(): string
	{
		return $this->direct_order_uuid; // phpcs:ignore
	}

	/**
	 * 1.26.10.16.3. Номер упаковки товара в прямом заказе
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDirectPackageNumber(): string
	{
		return $this->direct_package_number; // phpcs:ignore
	}
}
