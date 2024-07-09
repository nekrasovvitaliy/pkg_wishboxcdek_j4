<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class LocationResponse extends AbstractResponse
{
	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $code;

	/**
	 * Код города ФИАС
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
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $longitude = null;

	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $latitude = null;

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
	 * Название региона
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $region = null;

	/**
	 * Код региона СДЭК
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $region_code = null; // phpcs:ignore

	/**
	 * Название региона
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $sub_region = null; // phpcs:ignore

	/**
	 * Название города
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city;

	/**
	 * Название города
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCode(): int
	{
		return $this->code;
	}
	/**
	 * Код города ФИАС
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getFiasGuid(): ?string
	{
		return $this->fias_guid; // phpcs:ignore
	}

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

	/**
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getLongitude(): ?float
	{
		return $this->longitude;
	}

	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getLatitude(): ?float
	{
		return $this->latitude;
	}

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
	/**
	 * Название региона
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getRegion(): ?string
	{
		return $this->region;
	}

	/**
	 * Код региона СДЭК
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 */
	public function getRegionCode(): ?int
	{
		return $this->region_code; // phpcs:ignore
	}

	/**
	 * Название региона
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getSubRegion(): ?string
	{
		return $this->sub_region; // phpcs:ignore
	}

	/**
	 * Название города
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * Название города
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getAddress(): ?string
	{
		return $this->address;
	}
}
