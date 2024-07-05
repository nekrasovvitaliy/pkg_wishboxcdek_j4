<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Код страны в формате ISO_3166-1_alpha-2
 *
 * @since 1.0.0
 */
trait CountryCodeTrait
{
	/**
	 * Код страны в формате  ISO_3166-1_alpha-2.
	 *
	 * @var string
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected string $country_code; // phpcs:ignore

	/**
	 * Код страны в формате ISO_3166-1_alpha-2
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountryCode(): string
	{
		return $this->country_code; // phpcs:ignore
	}
}
