<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Адрес грузоотправителя
 *
 * Только для международных заказов
 *
 * @since 1.0.0
 */
trait ShipperAddressOptionalTrait
{
	/**
	 * Адрес грузоотправителя
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_address = null; // phpcs:ignore

	/**
	 * Адрес грузоотправителя
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipperAddress(): ?string
	{
		return $this->shipper_address; // phpcs:ignore
	}

	/**
	 * Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @param   string|null  $shipperAddress  Адрес грузоотправителя
	 *                                        Только для международных заказов
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setShipperAddress(?string $shipperAddress): static
	{
		$this->shipper_address = $shipperAddress; // phpcs:ignore

		return $this;
	}
}
