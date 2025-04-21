<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPatch;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class MoneyRequest extends AbstractRequest
{
	/**
	 * Сумма в валюте.
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	public float $value;

	/**
	 * Сумма НДС.
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	public ?float $vat_sum; // phpcs:ignore

	/**
	 * Ставка НДС.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	public ?int $vat_rate; // phpcs:ignore

	/**
	 * Сумма в валюте
	 *
	 * @param   float  $value  Сумма в валюте
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setValue(float $value): self
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * Сумма НДС
	 *
	 * @param   float|null  $vatSum  Сумма НДС
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setVatSum(?float $vatSum): self
	{
		$this->vat_sum = $vatSum; // phpcs:ignore

		return $this;
	}

	/**
	 * Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @param   integer|null  $vatRate  Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setVatRate(?int $vatRate): self
	{
		$this->vat_rate = $vatRate; // phpcs:ignore

		return $this;
	}
}
