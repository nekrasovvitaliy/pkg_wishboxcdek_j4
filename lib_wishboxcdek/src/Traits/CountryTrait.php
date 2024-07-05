<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Название страны населенного пункта
 *
 * @since 1.0.0
 */
trait CountryTrait
{
	/**
	 * Название страны населенного пункта
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $country;

	/**
	 * Название страны населенного пункта
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountry(): string
	{
		return $this->country;
	}
}
