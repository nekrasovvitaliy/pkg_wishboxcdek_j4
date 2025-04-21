<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class ServiceResponse extends AbstractResponse
{
	/**
	 * 1.25.1. Тип дополнительной услуги, код из справочника доп. услуг
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 1.25.2. Параметр дополнительной услуги
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $parameter;

	/**
	 * 1.25.3. Стоимость услуги (в валюте взаиморасчетов)
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $sum;

	/**
	 * 1.25.4. Общая сумма (итого с НДС и скидкой в валюте взаиморасчётов)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $total_sum; // phpcs:ignore

	/**
	 * 1.25.5. Процент скидки
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $discount_percent; // phpcs:ignore

	/**
	 * 1.25.6. общая сумма скидки
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $discount_sum; // phpcs:ignore

	/**
	 * 1.25.7. Ставка НДС
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $vat_rate; // phpcs:ignore

	/**
	 * 1.25.8. сумма НДС
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $vat_sum; // phpcs:ignore

	/**
	 * 1.25.1. Тип дополнительной услуги, код из справочника доп. услуг
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * 1.25.2. Параметр дополнительной услуги
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getParameter(): ?string
	{
		return $this->parameter;
	}

	/**
	 * 1.25.3. Стоимость услуги (в валюте взаиморасчетов)
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getSum(): ?float
	{
		return $this->sum;
	}

	/**
	 * 1.25.4. Общая сумма (итого с НДС и скидкой в валюте взаиморасчётов)
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getTotalSum(): float
	{
		return $this->total_sum; // phpcs:ignore
	}

	/**
	 * 1.25.5. Процент скидки
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getDiscountPercent(): float
	{
		return $this->discount_percent; // phpcs:ignore
	}

	/**
	 * 1.25.6. общая сумма скидки
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getDiscountSum(): float
	{
		return $this->discount_sum; // phpcs:ignore
	}

	/**
	 * 1.25.7. Ставка НДС
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getVatRate(): float
	{
		return $this->vat_rate; // phpcs:ignore
	}

	/**
	 * 1.25.8. сумма НДС
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getVatSum(): float
	{
		return $this->vat_sum; // phpcs:ignore
	}
}
