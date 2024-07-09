<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\RelatedEntity;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Request;

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
	 * @var Entity
	 *
	 * @since 1.0.0
	 */
	protected Entity $entity;

	/**
	 * 2. Информация о запросе над заказом
	 *
	 * @var Request[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * 3. Связанные сущности (если в запросе был передан корректный print)
	 *
	 * @var RelatedEntity[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $related_entities = null; // phpcs:ignore

	/**
	 * 1. Информация о заказе
	 *
	 * @return Entity
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
	}

	/**
	 * 2. Информация о запросе над заказом
	 *
	 * @return Request[]
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
	 * @return RelatedEntity[]|null
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
