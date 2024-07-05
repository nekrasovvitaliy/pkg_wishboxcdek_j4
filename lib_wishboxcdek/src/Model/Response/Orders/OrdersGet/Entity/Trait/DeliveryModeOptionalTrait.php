<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Истинный режим заказа:
 * 1 - дверь-дверь
 * 2 - дверь-склад
 * 3 - склад-дверь
 * 4 - склад-склад
 * 6 - дверь-постамат
 * 7 - склад-постамат
 * 8 - постамат-дверь
 * 9 - постамат-склад
 * 10 - постамат-постамат
 *
 * @since 1.0.0
 */
trait DeliveryModeOptionalTrait
{
	/**
	 * Истинный режим заказа:
	 * 1 - дверь-дверь
	 * 2 - дверь-склад
	 * 3 - склад-дверь
	 * 4 - склад-склад
	 * 6 - дверь-постамат
	 * 7 - склад-постамат
	 * 8 - постамат-дверь
	 * 9 - постамат-склад
	 * 10 - постамат-постамат
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $delivery_mode = null; // phpcs:ignore

	/**
	 * Истинный режим заказа:
	 * 1 - дверь-дверь
	 * 2 - дверь-склад
	 * 3 - склад-дверь
	 * 4 - склад-склад
	 * 6 - дверь-постамат
	 * 7 - склад-постамат
	 * 8 - постамат-дверь
	 * 9 - постамат-склад
	 * 10 - постамат-постамат
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryMode(): ?string
	{
		return $this->delivery_mode; // phpcs:ignore
	}

	/**
	 * Истинный режим заказа:
	 * 1 - дверь-дверь
	 * 2 - дверь-склад
	 * 3 - склад-дверь
	 * 4 - склад-склад
	 * 6 - дверь-постамат
	 * 7 - склад-постамат
	 * 8 - постамат-дверь
	 * 9 - постамат-склад
	 * 10 - постамат-постамат
	 *
	 * @param   string|null  $deliveryMode  Истинный режим заказа:
	 *                                      1 - дверь-дверь
	 *                                      2 - дверь-склад
	 *                                      3 - склад-дверь
	 *                                      4 - склад-склад
	 *                                      6 - дверь-постамат
	 *                                      7 - склад-постамат
	 *                                      8 - постамат-дверь
	 *                                      9 - постамат-склад
	 *                                      10 - постамат-постамат
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryMode(?string $deliveryMode): static
	{
		$this->delivery_mode = $deliveryMode; // phpcs:ignore

		return $this;
	}
}
