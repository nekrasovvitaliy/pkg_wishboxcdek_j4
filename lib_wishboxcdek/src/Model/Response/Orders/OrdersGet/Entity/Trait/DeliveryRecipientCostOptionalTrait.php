<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\MoneyResponse;

/**
 * Доп. сбор за доставку, которую ИМ берет с получателя.
 *
 * @since 1.0.0
 */
trait DeliveryRecipientCostOptionalTrait
{
	/**
	 * Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @var MoneyResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?MoneyResponse $delivery_recipient_cost = null; // phpcs:ignore

	/**
	 * Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @return MoneyResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryRecipientCost(): ?MoneyResponse
	{
		return $this->delivery_recipient_cost; // phpcs:ignore
	}

	/**
	 * Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @param   MoneyResponse|null  $deliveryRecipientCost  Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryRecipientCost(?MoneyResponse $deliveryRecipientCost): static
	{
		$this->delivery_recipient_cost = $deliveryRecipientCost; // phpcs:ignore

		return $this;
	}
}
