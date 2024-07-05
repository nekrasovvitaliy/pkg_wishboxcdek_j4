<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Плановая дата доставки. Передаётся при приёмке груза на склад
 *
 * @since 1.0.0
 */
trait PlannedDeliveryDateOptionalTrait
{
	/**
	 * Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $planned_delivery_date; // phpcs:ignore

	/**
	 * Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getPlannedDeliveryDate(): ?string
	{
		return $this->planned_delivery_date; // phpcs:ignore
	}

	/**
	 * Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @param   string|null  $plannedDeliveryDate  Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setPlannedDeliveryDate(?string $plannedDeliveryDate): static
	{
		$this->planned_delivery_date = $plannedDeliveryDate; // phpcs:ignore

		return $this;
	}
}
