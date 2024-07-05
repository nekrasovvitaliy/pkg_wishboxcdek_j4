<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
 *
 * @since 1.0.0
 */
trait ShipmentPointOptionalTrait
{
	/**
	 * Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipment_point = null; // phpcs:ignore

	/**
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipmentPoint(): ?string
	{
		return $this->shipment_point; // phpcs:ignore
	}

	/**
	 * Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @param   string|null  $shipmentPoint  Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setShipmentPoint(?string $shipmentPoint): static
	{
		$this->shipment_point = $shipmentPoint; // phpcs:ignore

		return $this;
	}
}
