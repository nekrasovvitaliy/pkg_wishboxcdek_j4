<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Признак клиентского возврата
 *
 * @since 1.0.0
 */
trait IsClientReturnTrait
{
	/**
	 * Признак клиентского возврата
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $is_client_return; // phpcs:ignore

	/**
	 * Признак клиентского возврата
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getIsClientReturn(): string
	{
		return $this->is_client_return; // phpcs:ignore
	}

	/**
	 * Признак клиентского возврата
	 *
	 * @param   string  $isClientReturn  Комментарий к заказу
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setIsClientReturn(string $isClientReturn): static
	{
		$this->is_client_return = $isClientReturn; // phpcs:ignore

		return $this;
	}
}
