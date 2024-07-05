<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Код тарифа
 *
 * @since 1.0.0
 */
trait TariffCodeTrait
{
	/**
	 * Код тарифа
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $tariff_code; // phpcs:ignore

	/**
	 * Код тарифа
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getTariffCode(): int
	{
		return $this->tariff_code; // phpcs:ignore
	}

	/**
	 * Код тарифа
	 *
	 * @param   integer  $tariffCode  Tariff code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setTariffCode(int $tariffCode): self
	{
		$this->tariff_code = $tariffCode; // phpcs:ignore

		return $this;
	}
}
