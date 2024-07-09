<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Location\CitiesGet;

use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\ErrorResponse;
use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class CityResponse extends AbstractResponse
{
	/**
	 * 1. Код населенного пункта СДЭК
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $code;

	/**
	 * 2. Название населенного пункта.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city;

	/**
	 * 3. Уникальный идентификатор ФИАС населенного пункта
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * 4. Идентификатор города в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city_uuid; // phpcs:ignore

	/**
	 * 6. Код страны населенного пункта в формате  ISO_3166-1_alpha-2
	 *    по документам обязательное, но на самом деле нет
	 *
	 * @var string|null
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_code = null; // phpcs:ignore

	/**
	 * 7. Название страны населенного пункта
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $country;

	/**
	 * 8. Название региона населенного пункта
	 *    по документам обязательное, но на самом деле нет
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $region = null;

	/**
	 * 9. Код региона СДЭК
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $region_code = null; // phpcs:ignore

	/**
	 * 12. Название района региона населенного пункта
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $sub_region = null; // phpcs:ignore

	/**
	 * 14. Долгота центра населенного пункта
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $longitude = null;

	/**
	 * 15. Широта центра населенного пункта
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $latitude = null;

	/**
	 * 16. Часовой пояс населенного пункта
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	public ?string $time_zone = null; // phpcs:ignore

	/**
	 * 17. Ограничение на сумму наложенного платежа в населенном пункте
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $payment_limit; // phpcs:ignore

	/**
	 * 18. Список ошибок
	 *
	 * @var ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $errors; // phpcs:ignore

	/**
	 * 1. Код населенного пункта СДЭК
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
	 * 2. Название населенного пункта.
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
	 * 3. Уникальный идентификатор ФИАС населенного пункта
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getFiasGuid(): ?string
	{
		return $this->fias_guid; // phpcs:ignore
	}

	/**
	 * 4. Идентификатор города в ИС СДЭК
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCityUuid(): string
	{
		return $this->city_uuid; // phpcs:ignore
	}

	/**
	 * 6. Код страны населенного пункта в формате  ISO_3166-1_alpha-2
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getCountryCode(): ?string
	{
		return $this->country_code; // phpcs:ignore
	}

	/**
	 * 7. Название страны населенного пункта
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * 8. Название региона населенного пункта
	 *    по документам обязательное, но на самом деле нет
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
	 * 9. Код региона СДЭК
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
	 * 12. Название района региона населенного пункта
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getSubRegion(): ?string
	{
		return $this->sub_region; // phpcs:ignore
	}

	/**
	 * 14. Долгота центра населенного пункта
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
	 * 15. Широта центра населенного пункта
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
	 * 16. Часовой пояс населенного пункта
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTimeZone(): ?string
	{
		return $this->time_zone; // phpcs:ignore
	}

	/**
	 * 17. Ограничение на сумму наложенного платежа в населенном пункте
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPaymentLimit(): float
	{
		return $this->payment_limit; // phpcs:ignore
	}

	/**
	 * 18. Список ошибок
	 *
	 * @return ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 */
	public function getErrors(): ?array
	{
		return $this->errors; // phpcs:ignore
	}
}
