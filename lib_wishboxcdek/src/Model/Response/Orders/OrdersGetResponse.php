<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Orders;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\EntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\RelatedEntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\RequestResponse;

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
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\EntityResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?EntityResponse $entity = null;

	/**
	 * 2. Информация о запросе/запросах над заказом
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\RequestResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * 3. Связанные с заказом сущности
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\RelatedEntityResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $related_entities = null; // phpcs:ignore

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

	/**
	 * 3. Связанные с заказом сущности
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
