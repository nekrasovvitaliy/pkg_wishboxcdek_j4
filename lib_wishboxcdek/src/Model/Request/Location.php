<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

use WishboxCdekSDK2\Constants;
use WishboxCdekSDK2\Traits\LocationTrait;

/**
 * Class Location
 *
 * Represents a location with various attributes such as address, country, region, etc.
 *
 * @since 1.0.0
 */
class Location extends Source
{
	use LocationTrait;

	/**
	 * Полный адрес с указанием страны, региона, города, и т.д.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $address_full; // phpcs:ignore

	/**
	 * Название страны населенного пункта.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $country;

	/**
	 * Массив кодов стран в формате  ISO_3166-1_alpha-2.
	 *
	 * @var string[]|null
	 *
	 * @since 1.0.0
	 */
	protected array $country_codes; // phpcs:ignore

	/**
	 * Локализация по умолчанию 'rus'.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $lang = 'rus';

	/**
	 * Ограничение выборки результата. По умолчанию 500.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $size;

	/**
	 * Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $page;

	/**
	 * Экспресс-метод установки кода локации.
	 *
	 * @param   int $code - код города\региона
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

	/**
	 * Экспресс-метод установки кода локации.
	 *
	 * @param   string  $postalCode  Postal code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withPostalCode(string $postalCode): self
	{
		$instance = new self;

		$instance->postal_code = $postalCode; // phpcs:ignore

		return $instance;
	}

	/**
	 * Экспресс-метод установки адреса.
	 *
	 * @param   string  $address  Address
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withAddress(string $address): self
	{
		$instance = new self;

		$instance->address = $address;

		return $instance;
	}

	/**
	 * Экспресс-метод установки города.
	 *
	 * @param   string  $city  City
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withCities(string $city): self
	{
		$instance = new self;

		$instance->city = $city;

		return $instance;
	}

	/**
	 * @param   int $code  Code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCode(int $code): self
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * @param   string  $countryCode  Country code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCountryCode(string $countryCode = 'RU'): self
	{
		$this->country_code = $countryCode;  // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string  $country  Country
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCountry(string $country): self
	{
		$this->country = $country;

		return $this;
	}

	/**
	 * @param   string[]  $countryCodes  Country codes
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCountryCodes(array $countryCodes): self
	{
		$this->country_codes = $countryCodes;  // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string  $address  Address
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setAddress(string $address): self
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * @param   integer  $postalCode  Postal code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setPostalCode(int $postalCode): self
	{
		$this->postal_code = $postalCode;  // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string  $city  City
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCity(string $city): self
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * @param   string  $region  Region
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setRegion(string $region): self
	{
		$this->region = $region;

		return $this;
	}

	/**
	 * @param   string $subRegion  Sub region
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setSubRegion(string $subRegion): self
	{
		$this->sub_region = $subRegion; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   integer  $regionCode Region code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setRegionCode(int $regionCode): self
	{
		$this->region_code = $regionCode; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string $kladrCode  Kladr code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setKladrCode(string $kladrCode): self
	{
		$this->kladr_code = $kladrCode; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string $fiasGuid  Fias guid
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setFiasGuid(string $fiasGuid): self
	{
		$this->fias_guid = $fiasGuid; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string  $size  Size
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setSize(int $size): self
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * @param   string  $lang  Lang
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setLang(string $lang = 'rus'): self
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * @param   string  $timeZone  Time zone
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setTimeZone(string $timeZone): self
	{
		$this->time_zone = $timeZone; // phpcs:ignore

		return $this;
	}

	/**
	 * Устанавливает уникальный идентификатор ФИАС региона населенного пункта.
	 *
	 * @param   string  $fiasRegionGuid  Уникальный идентификатор ФИАС региона населенного пункта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setFiasRegionGuid(string $fiasRegionGuid): self
	{
		$this->fias_region_guid = $fiasRegionGuid; // phpcs:ignore

		return $this;
	}

	/**
	 * Устанавливает полный адрес с указанием страны, региона, города, и т.д.
	 *
	 * @param   string  $addressFull  Полный адрес с указанием страны, региона, города, и т.д.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setAddressFull(string $addressFull): self
	{
		$this->address_full = $addressFull; // phpcs:ignore

		return $this;
	}

	/**
	 * Устанавливает настройки локации на Населенные пункты.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function cities(): self
	{
		$this->pattern = Constants::CITIES_FILTER;

		return $this;
	}

	/**
	 * Устанавливает настройки локации на Регионы.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function regions(): self
	{
		$this->pattern = Constants::REGIONS_FILTER;

		return $this;
	}

	/**
	 * Устанавливает номер страницы выборки результата. По умолчанию 0.
	 *
	 * @param   int|null $page Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setPage(?int $page): self
	{
		$this->page = $page;

		return $this;
	}
}
