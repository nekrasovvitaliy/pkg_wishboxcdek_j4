<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Orders;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersDelete\EntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersDelete\RequestResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrdersDeleteResponse extends AbstractResponse
{
	/**
	 * 1. Информация о заказе
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersDelete\EntityResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?EntityResponse $entity = null;

	/**
	 * 2. Информация о запросе/запросах над заказом
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersDelete\RequestResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * 1. Информация о заказе
	 *
	 * @return EntityResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getEntity(): ?EntityResponse
	{
		return $this->entity;
	}

	/**
	 * 2. Информация о запросе/запросах над заказом
	 *
	 * @return RequestResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRequests(): array
	{
		return $this->requests;
	}
}
