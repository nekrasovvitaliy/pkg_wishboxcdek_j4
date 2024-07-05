<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\StatusResponse;

/**
 * Список статусов по заказу, отсортированных по дате и времени
 *
 * @since 1.0.0
 */
trait StatusesTrait
{
	/**
	 * Список статусов по заказу, отсортированных по дате и времени
	 *
	 * @var StatusResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $statuses; // phpcs:ignore

	/**
	 * Список статусов по заказу, отсортированных по дате и времени
	 *
	 * @return StatusResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getStatuses(): array
	{
		return $this->statuses; // phpcs:ignore
	}

	/**
	 * Список статусов по заказу, отсортированных по дате и времени
	 *
	 * @param   StatusResponse[]  $statuses  Список статусов по заказу, отсортированных по дате и времени
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setStatuses(array $statuses): static
	{
		$this->statuses = $statuses; // phpcs:ignore

		return $this;
	}
}
