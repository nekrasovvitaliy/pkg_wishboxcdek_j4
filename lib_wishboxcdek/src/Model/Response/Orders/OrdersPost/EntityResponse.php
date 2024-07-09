<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class EntityResponse extends AbstractResponse
{
	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid; // phpcs:ignore

	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getUuid(): string
	{
		return $this->uuid; // phpcs:ignore
	}
}
