<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
 *
 * @since 1.0.0
 */
trait CityCodeTrait
{
	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $city_code; // phpcs:ignore

	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCityCode(): int
	{
		return $this->city_code; // phpcs:ignore
	}
}
