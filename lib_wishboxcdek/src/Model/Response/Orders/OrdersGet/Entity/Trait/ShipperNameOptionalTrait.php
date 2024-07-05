<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Грузоотправитель
 *
 * Только для международных заказов
 *
 * @since 1.0.0
 */
trait ShipperNameOptionalTrait
{
	/**
	 * Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_name = null; // phpcs:ignore

	/**
	 * Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipperName(): ?string
	{
		return $this->shipper_name; // phpcs:ignore
	}

	/**
	 * Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @param   string|null  $shipperName  Грузоотправитель
	 *                                     Только для международных заказов
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setShipperName(?string $shipperName): static
	{
		$this->shipper_name = $shipperName; // phpcs:ignore

		return $this;
	}
}
