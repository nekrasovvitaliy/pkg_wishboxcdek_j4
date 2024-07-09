<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
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
class OrdersGetResponse extends AbstractResponse
{
	/**
	 * 1. Информация о заказе
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity|null
	 *
	 * @since 1.0.0
	 */
	protected ?Entity $entity = null;

	/**
	 * 2. Информация о запросе/запросах над заказом
	 *
	 * @var Request[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * 3. Связанные с заказом сущности
	 *
	 * @var RelatedEntity[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $related_entities = null; // phpcs:ignore

	/**
	 * 1. Информация о заказе
	 *
	 * @return Entity|null
	 *
	 * @since 1.0.0
	 */
	public function getEntity(): ?Entity
	{
		return $this->entity;
	}

	/**
	 * 2. Информация о запросе/запросах над заказом
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
	 * 3. Связанные с заказом сущности
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
