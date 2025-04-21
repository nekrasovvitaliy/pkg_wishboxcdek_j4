<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Calculator\TariffListPost;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class LocationRequest extends AbstractRequest
{
	/**
	 * 6.1. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $code = null;

	/**
	 * 6.2. Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * 6.3. Код страны в формате ISO_3166-1_alpha-2 (по умолчанию RU)
	 *
	 * @var string|null
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_code = null; // phpcs:ignore

	/**
	 * 6.4. Название города
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $city = null;

	/**
	 * 6.5. Полная строка адреса
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * 6.1. Установить код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @param   integer|null  $code  Code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCode(?int $code): self
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * 6.2. Установить почтовый индекс
	 *
	 * @param   string|null  $postalCode  Postal code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPostalCode(?string $postalCode): self
	{
		$this->postal_code = $postalCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 6.3. Установить код страны в формате ISO_3166-1_alpha-2 (по умолчанию RU)
	 *
	 * @param   string|null  $countryCode  Country code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCountryCode(?string $countryCode): self
	{
		$this->country_code = $countryCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 6.4. Установить название города
	 *
	 * @param   string|null  $city  City
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCity(?string $city): self
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * 6.5. Установить полную строку адреса
	 *
	 * @param   string|null  $address  Address
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAddress(?string $address): self
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * Экспресс-метод установки кода локации.
	 *
	 * @param   integer  $code  Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withCode(int $code): self
	{
		$instance = new self;
		$instance->code = $code;

		return $instance;
	}
}
