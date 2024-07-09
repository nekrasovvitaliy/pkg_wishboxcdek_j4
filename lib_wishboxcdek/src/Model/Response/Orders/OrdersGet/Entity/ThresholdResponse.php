<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class ThresholdResponse extends AbstractResponse
{
	/**
	 * 1.19.1. Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $threshold;

	/**
	 * 1.19.2. Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал.
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $sum;

	/**
	 * 1.19.3. Сумма НДС включённая в доп. сбор за доставку
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	public ?float $vat_sum; // phpcs:ignore

	/**
	 * 1.19.4. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	public ?int $vat_rate; // phpcs:ignore

	/**
	 * 1.19.1. Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты.
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getThreshold(): int
	{
		return $this->threshold;
	}

	/**
	 * 1.19.2. Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал.
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @since 1.0.0
	 */
	public function getSum(): float
	{
		return $this->sum;
	}

	/**
	 * 1.19.3. Сумма НДС включённая в доп. сбор за доставку
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getVatSum(): ?float
	{
		return $this->vat_sum; // phpcs:ignore
	}

	/**
	 * 1.19.4. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 */
	public function getVatRate(): ?int
	{
		return $this->vat_rate; // phpcs:ignore
	}
}
