<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Дата инвойса
 * Только для международных заказов
 *
 * @since 1.0.0
 */
trait DateInvoiceOptionalTrait
{
	/**
	 * Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date_invoice = null; // phpcs:ignore

	/**
	 * Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDateInvoice(): ?string
	{
		return $this->date_invoice; // phpcs:ignore
	}

	/**
	 * Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @param   string|null  $dateInvoice  Дата инвойса
	 *                                     Только для международных заказов
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDateInvoice(?string $dateInvoice): static
	{
		$this->date_invoice = $dateInvoice; // phpcs:ignore

		return $this;
	}
}
