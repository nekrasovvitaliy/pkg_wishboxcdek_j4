<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPatch;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class ThresholdRequest extends AbstractRequest
{
	/**
	 * 13.1 Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	public int $threshold;

	/**
	 * 13.2. Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал (в том числе и НДС)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	public float $sum;

	/**
	 * 13.3. Сумма НДС, включённая в доп. сбор за доставку
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	public ?float $vat_sum; // phpcs:ignore

	/**
	 * 13.4. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	public ?int $vat_rate; // phpcs:ignore

	/**
	 * 13.1 Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты
	 *
	 * @param   integer  $threshold  Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setThreshold(int $threshold): self
	{
		$this->threshold = $threshold;

		return $this;
	}

	/**
	 * 13.2. Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал (в том числе и НДС)
	 *
	 * @param   float  $sum  Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал (в том числе и НДС)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setSum(float $sum): self
	{
		$this->sum = $sum;

		return $this;
	}

	/**
	 * 13.3. Сумма НДС, включённая в доп. сбор за доставку
	 *
	 * @param   float|null  $vatSum  Сумма НДС, включённая в доп. сбор за доставку
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
	 * 13.4. Ставка НДС (значение - 0, 10, 12, 20, null - нет НДС)
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
