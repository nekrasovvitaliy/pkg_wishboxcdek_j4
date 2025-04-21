<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class LocationResponse extends AbstractResponse
{
	/**
	 * 4.1. Код страны в формате  ISO_3166-1_alpha-2.
	 *
	 * @var string
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected string $country_code; // phpcs:ignore

	/**
	 * 4.2. Код региона СДЭК
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $region_code; // phpcs:ignore

	/**
	 * 4.3. Название региона
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $region;

	/**
	 * 4.4. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $city_code; // phpcs:ignore

	/**
	 * 4.5. Название города
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city;

	/**
	 * 4.6. Код города ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * 4.7. Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * 4.8 Координаты местоположения (долгота) в градусах
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $longitude;

	/**
	 * 4.9. Координаты местоположения (широта) в градусах
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $latitude;

	/**
	 * 4.10. Адрес (улица, дом, офис) в указанном городе
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $address;

	/**
	 * 4.11. Полный адрес с указанием страны, региона, города, и т.д.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $address_full; // phpcs:ignore

	/**
	 * 4.12. Идентификатор города
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $city_uuid = null; // phpcs:ignore

	/**
	 * 4.1. Код страны в формате  ISO_3166-1_alpha-2.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCountryCode(): string // phpcs:ignore
	{
		return $this->country_code; // phpcs:ignore
	}

	/**
	 * 4.2. Код региона СДЭК
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRegionCode(): int // phpcs:ignore
	{
		return $this->region_code; // phpcs:ignore
	}

	/**
	 * 4.3. Название региона
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRegion(): string
	{
		return $this->region;
	}

	/**
	 * 4.4. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCityCode(): int
	{
		return $this->city_code; // phpcs:ignore
	}

	/**
	 * 4.5. Название города
	 * @return string
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * 4.6. Код города ФИАС
	 * @return string|null
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getFiasGuid(): ?string // phpcs:ignore
	{
		return $this->fias_guid; // phpcs:ignore
	}

	/**
	 * 4.7. Почтовый индекс
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPostalCode(): ?string
	{
		return $this->postal_code; // phpcs:ignore
	}

	/**
	 * 4.8 Координаты местоположения (долгота) в градусах
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLongitude(): float
	{
		return $this->longitude;
	}

	/**
	 * 4.9. Координаты местоположения (широта) в градусах
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLatitude(): float
	{
		return $this->latitude;
	}

	/**
	 * 4.10. Адрес (улица, дом, офис) в указанном городе
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * 4.11. Полный адрес с указанием страны, региона, города, и т.д.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAddressFull(): string
	{
		return $this->address_full; // phpcs:ignore
	}

	/**
	 * 4.12. Идентификатор города
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCityUuid(): ?string
	{
		return $this->city_uuid; // phpcs:ignore
	}
}
