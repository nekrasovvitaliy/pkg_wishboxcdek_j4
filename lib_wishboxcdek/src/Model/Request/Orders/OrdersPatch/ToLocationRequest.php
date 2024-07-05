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
class ToLocationRequest extends AbstractRequest
{
	/**
	 * 18.1. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $code = null;

	/**
	 * 18.2. Уникальный идентификатор ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * 18.3 Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * 18.4. Долгота
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $longitude = null; // phpcs:ignore

	/**
	 * 18.5. Широта
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $latitude = null; // phpcs:ignore

	/**
	 * 18.6 Код страны в формате ISO_3166-1_alpha-2 (по умолчанию RU)
	 *
	 * @var string|null
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_code = null; // phpcs:ignore

	/**
	 * 18.7. Название региона, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $region = null;

	/**
	 * 18.8. Код региона СДЭК, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $regionCode = null;

	/**
	 * 18.9. Название района региона, уточняющий параметр для поля region. Нельзя передавать без region
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $subRegion = null;

	/**
	 * 18.10. Название города, уточняющий параметр для postal_code. Можно передавать без postal_code
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $city = null;

	/**
	 * 18.12. Строка адреса
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * 18.1. Код населенного пункта СДЭК (метод "Список населенных пунктов")
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
	 * 18.2. Уникальный идентификатор ФИАС
	 *
	 * @param   string|null  $fiasGuid  Уникальный идентификатор ФИАС
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setFiasGuid(?string $fiasGuid): self
	{
		$this->fias_guid = $fiasGuid; // phpcs:ignore

		return $this;
	}

	/**
	 * 18.3. Почтовый индекс
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
	 * 18.4. Долгота
	 *
	 * @param   float|null  $longitude  Долгота
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setLongitude(?float $longitude): self
	{
		$this->longitude = $longitude;

		return $this;
	}

	/**
	 * 18.5. Широта
	 *
	 * @param   float|null  $latitude  Широта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setLatitude(?float $latitude): self
	{
		$this->latitude = $latitude;

		return $this;
	}

	/**
	 * 18.6. Код страны в формате  ISO_3166-1_alpha-2 (по умолчанию RU)
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
	 * 18.7. Название региона, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @param   string|null  $region  Название региона, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setRegion(?string $region): self
	{
		$this->region = $region;

		return $this;
	}

	/**
	 * 18.8. Код региона СДЭК, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @param   integer|null  $regionCode  Код региона СДЭК, уточняющий параметр для поля city. Нельзя передавать без city
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setRegionCode(?int $regionCode): self
	{
		$this->regionCode = $regionCode;

		return $this;
	}

	/**
	 * 18.9. Название района региона, уточняющий параметр для поля region. Нельзя передавать без region
	 *
	 * @param   string|null  $subRegion  Название района региона, уточняющий параметр для поля region. Нельзя передавать без region
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setSubRegion(?string $subRegion): self
	{
		$this->subRegion = $subRegion;

		return $this;
	}

	/**
	 * 18.10. Название города, уточняющий параметр для postal_code. Можно передавать без postal_code
	 *
	 * @param   string|null  $city  Название города, уточняющий параметр для postal_code. Можно передавать без postal_code
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
	 * 18.12. Строка адреса
	 *
	 * @param   string|null  $address  Строка адреса
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
}
