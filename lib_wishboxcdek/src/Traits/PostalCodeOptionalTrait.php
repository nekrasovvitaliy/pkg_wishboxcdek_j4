<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Почтовый индекс
 *
 * @since 1.0.0
 */
trait PostalCodeOptionalTrait
{
	/**
	 * Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * Почтовый индекс
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getPostalCode(): ?string
	{
		return $this->postal_code; // phpcs:ignore
	}
}
