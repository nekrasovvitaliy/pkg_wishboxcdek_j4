<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\DeliveryDetailResponse;

/**
 * Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
 *
 * @since 1.0.0
 */
trait TransactedPaymentOptionalTrait
{
	/**
	 * Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $transacted_payment = null; // phpcs:ignore

	/**
	 * Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
	 *
	 * @return DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getTransactedPaymentOptional(): ?bool
	{
		return $this->transacted_payment; // phpcs:ignore
	}

	/**
	 * Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
	 *
	 * @param   boolean|null  $transactedPayment  Признак того, что по заказу была получена информация
	 *                                            о переводе наложенного платежа интернет-магазину
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setTransactedPaymentOptional(?bool $transactedPayment): static
	{
		$this->transacted_payment = $transactedPayment; // phpcs:ignore

		return $this;
	}
}
