<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Orders;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPost\EntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPost\RelatedEntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPost\RequestResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrdersPostResponse extends AbstractResponse
{
	/**
	 * 1. Информация о заказе
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersPost\EntityResponse
	 *
	 * @since 1.0.0
	 */
	protected EntityResponse $entity;

	/**
	 * 2. Информация о запросе над заказом
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersPost\Request[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * 3. Связанные сущности (если в запросе был передан корректный print)
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersPost\RelatedEntityResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $related_entities = null; // phpcs:ignore

	/**
	 * 1. Информация о заказе
	 *
	 * @return EntityResponse
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getEntity(): EntityResponse
	{
		return $this->entity;
	}

	/**
	 * 2. Информация о запросе над заказом
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

	/**
	 * 3. Связанные сущности (если в запросе был передан корректный print)
	 *
	 * @return RelatedEntityResponse[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRelatedEntities(): ?array
	{
		return $this->related_entities; // phpcs:ignore
	}
}
