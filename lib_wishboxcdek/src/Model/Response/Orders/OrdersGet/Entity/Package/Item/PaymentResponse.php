<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Package\Item;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class PaymentResponse extends AbstractResponse
{
	/**
	 * 1.26.10.3.1. Сумма наложенного платежа (в случае предоплаты = 0)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	public float $value;

	/**
	 * 1.26.10.3.2. Сумма НДС
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	public ?float $vat_sum = null; // phpcs:ignore

	/**
	 * 1.26.10.3.3. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	public ?int $vat_rate = null; // phpcs:ignore

	/**
	 * 1.26.10.3.1. Сумма наложенного платежа (в случае предоплаты = 0)
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getValue(): float
	{
		return $this->value;
	}

	/**
	 * 1.26.10.3.2. Сумма НДС
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getVatSum(): ?float
	{
		return $this->vat_sum; // phpcs:ignore
	}

	/**
	 * 1.26.10.3.3. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getVatRate(): ?int
	{
		return $this->vat_rate; // phpcs:ignore
	}
}
