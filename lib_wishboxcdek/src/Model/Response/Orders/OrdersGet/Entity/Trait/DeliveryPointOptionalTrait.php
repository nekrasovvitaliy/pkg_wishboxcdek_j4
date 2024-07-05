<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
 *
 * @since 1.0.0
 */
trait DeliveryPointOptionalTrait
{
	/**
	 * Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $delivery_point = null; // phpcs:ignore

	/**
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryPoint(): ?string
	{
		return $this->delivery_point; // phpcs:ignore
	}

	/**
	 * Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @param   string|null  $deliveryPoint  Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryPoint(?string $deliveryPoint): static
	{
		$this->delivery_point = $deliveryPoint; // phpcs:ignore

		return $this;
	}
}
