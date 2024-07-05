<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\Order\LocationResponse;

/**
 * Адрес получения
 *
 * @since 1.0.0
 */
trait ToLocationTrait
{
	/**
	 * Адрес получения
	 *
	 * @var LocationResponse
	 *
	 * @since 1.0.0
	 */
	protected LocationResponse $to_location; // phpcs:ignore

	/**
	 * Адрес получения
	 *
	 * @return LocationResponse
	 *
	 * @since 1.0.0
	 */
	public function getToLocation(): LocationResponse
	{
		return $this->to_location; // phpcs:ignore
	}

	/**
	 * Адрес получения
	 *
	 * @param   LocationResponse  $toLocation  Адрес получения
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setToLocation(LocationResponse $toLocation): static
	{
		$this->to_location = $toLocation; // phpcs:ignore

		return $this;
	}
}
