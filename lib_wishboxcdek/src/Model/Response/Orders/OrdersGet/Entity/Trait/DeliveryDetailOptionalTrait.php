<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\DeliveryDetailResponse;

/**
 * Информация о вручении
 *
 * @since 1.0.0
 */
trait DeliveryDetailOptionalTrait
{
	/**
	 * Информация о вручении
	 *
	 * @var DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?DeliveryDetailResponse $delivery_detail = null; // phpcs:ignore

	/**
	 * Информация о вручении
	 *
	 * @return DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryDetail(): ?DeliveryDetailResponse
	{
		return $this->delivery_detail; // phpcs:ignore
	}

	/**
	 * Информация о вручении
	 *
	 * @param   DeliveryDetailResponse|null  $deliveryDetail  Информация о вручении
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryDetail(?DeliveryDetailResponse $deliveryDetail): static
	{
		$this->delivery_detail = $deliveryDetail; // phpcs:ignore

		return $this;
	}
}
