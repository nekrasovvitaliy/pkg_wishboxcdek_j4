<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Trait LocationTrait
 *
 * This trait provides common properties and methods related to a location.
 *
 * @since 1.0.0
 */
trait LocationTrait
{
	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов").
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $code;

	/**
	 * Уникальный идентификатор ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * Долгота.
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected float $longitude;

	/**
	 * Широта.
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected float $latitude;

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
	 * Название региона.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $region;

	/**
	 * Код региона (справочник СДЭК).
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $region_code; // phpcs:ignore

	/**
	 * Название района региона населенного пункта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected $sub_region; // phpcs:ignore

	/**
	 * Название города.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected $city;

	/**
	 * Код КЛАДР.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $kladr_region_code; // phpcs:ignore

	/**
	 * Строка адреса.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * Массив почтовых индексов.
	 *
	 * @var array|null
	 *
	 * @since 1.0.0
	 */
	protected $postal_codes; // phpcs:ignore

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountryCode()
	{
		return $this->country_code; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountryCodes()
	{
		return $this->country_codes; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getPostalCode()
	{
		return $this->postal_code; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRegion()
	{
		return $this->region;
	}

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getRegionCode()
	{
		return $this->region_code; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getKladrRegionCode()
	{
		return $this->kladr_region_code; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getFiasGuid()
	{
		return $this->fias_guid; // phpcs:ignore
	}

	/**
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getSubRegion(): ?string
	{
		return $this->sub_region; // phpcs:ignore
	}
}
