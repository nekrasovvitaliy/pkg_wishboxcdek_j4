<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * Связанная с заказом сущность
 *
 * @since 1.0.0
 */
class RelatedEntityResponse extends AbstractResponse
{
	/**
	 * 3.1 Тип связанной сущности
	 *
	 * Может принимать значения:
	 * waybill - квитанция к заказу
	 * barcode - ШК места к заказу
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * 3.2 Идентификатор сущности, связанной с заказом
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid;

	/**
	 * 3.1 Тип связанной сущности
	 *
	 *  Может принимать значения:
	 *  waybill - квитанция к заказу
	 *  barcode - ШК места к заказу
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * 3.2 Идентификатор сущности, связанной с заказом
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
}
