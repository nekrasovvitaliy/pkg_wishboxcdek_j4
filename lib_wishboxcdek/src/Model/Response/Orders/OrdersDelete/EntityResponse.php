<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersDelete;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * Class Orders.
 *
 * @since 1.0.0
 */
class EntityResponse extends AbstractResponse
{
	/**
	 * 1.1. Идентификатор заказа в ИС СДЭК, который был изменен
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $uuid = null;

	/**
	 * 1.1. Идентификатор заказа в ИС СДЭК, который был изменен
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getUuid(): ?string
	{
		return $this->uuid;
	}
}
