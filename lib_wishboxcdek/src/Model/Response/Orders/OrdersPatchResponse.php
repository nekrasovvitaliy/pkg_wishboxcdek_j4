<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Orders;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPatch\EntityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPatch\RequestResponse;

/**
 * @since 1.0.0
 */
class OrdersPatchResponse extends AbstractResponse
{
	/**
	 * 1. Информация о заказе
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersPatch\EntityResponse
	 *
	 * @since 1.0.0
	 */
	protected EntityResponse $entity;

	/**
	 * 2. Информация о запросе над заказом
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersPatch\RequestResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

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
}
