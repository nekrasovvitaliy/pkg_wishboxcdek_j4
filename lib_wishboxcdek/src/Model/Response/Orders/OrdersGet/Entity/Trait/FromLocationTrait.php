<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\Order\LocationResponse;

/**
 * Адрес отправления
 *
 * @since 1.0.0
 */
trait FromLocationTrait
{
	/**
	 * Адрес отправления
	 *
	 * @var LocationResponse
	 *
	 * @since 1.0.0
	 */
	protected LocationResponse $from_location; // phpcs:ignore

	/**
	 * Адрес отправления
	 *
	 * @return LocationResponse
	 *
	 * @since 1.0.0
	 */
	public function getFromLocation(): LocationResponse
	{
		return $this->from_location; // phpcs:ignore
	}

	/**
	 * Адрес отправления
	 *
	 * @param   LocationResponse  $fromLocation  Отправитель
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setFromLocation(LocationResponse $fromLocation): static
	{
		$this->from_location = $fromLocation; // phpcs:ignore

		return $this;
	}
}
