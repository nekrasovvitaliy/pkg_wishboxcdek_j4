<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\ThresholdResponse;

/**
 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
 *
 * @since 1.0.0
 */
trait DeliveryRecipientCostAdvOptionalTrait
{
	/**
	 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @var ThresholdResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $delivery_recipient_cost_adv = []; // phpcs:ignore

	/**
	 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @return ThresholdResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryRecipientCostAdv(): array
	{
		return $this->delivery_recipient_cost_adv; // phpcs:ignore
	}

	/**
	 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @param   ThresholdResponse[]  $deliveryRecipientCostAdv  Доп. сбор за доставку (которую ИМ берет с получателя),
	 *                                                             в зависимости от суммы заказа
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryRecipientCostAdv(array $deliveryRecipientCostAdv): static
	{
		$this->delivery_recipient_cost_adv = $deliveryRecipientCostAdv; // phpcs:ignore

		return $this;
	}
}
