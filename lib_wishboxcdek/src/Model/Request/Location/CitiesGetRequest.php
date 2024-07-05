<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Location;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class CitiesGetRequest extends AbstractRequest
{
	/**
	 * 1. Массив кодов стран в формате  ISO_3166-1_alpha-2
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_codes = null; // phpcs:ignore

	/**
	 * 2. Код региона СДЭК
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $region_code = null; // phpcs:ignore

	/**
	 * 6. Уникальный идентификатор ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * 7. Почтовый индекс
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $postal_code = null; // phpcs:ignore

	/**
	 * 8. Код населенного пункта СДЭК (метод "Список населенных пунктов").
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $code = null;

	/**
	 * 9. Название населенного пункта. Должно соответствовать полностью
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $city = null;

	/**
	 * 10. Ограничение выборки результата. По умолчанию 1000
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $size = null;

	/**
	 * 11. Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $page;

	/**
	 * 12. Локализация по умолчанию 'rus'.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $lang = null;

	/**
	 * 13. Ограничение на сумму наложенного платежа:
	 * -1 - ограничения нет;
	 * 0 - наложенный платеж не принимается;
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $payment_limit = null; // phpcs:ignore

	/**
	 * 1. Массив кодов стран в формате  ISO_3166-1_alpha-2
	 *
	 * @param   string[]  $countryCodes  Country code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCountryCodes(string $countryCodes): self
	{
		$this->country_codes = $countryCodes;  // phpcs:ignore

		return $this;
	}

	/**
	 * 2. Код региона СДЭК
	 * @param   integer  $regionCode  Region code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setRegionCode(int $regionCode): self
	{
		$this->region_code = $regionCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 6. Уникальный идентификатор ФИАС населенного пункта
	 *
	 * @param   string  $fiasGuid  Fias guid
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setFiasGuid(string $fiasGuid): self
	{
		$this->fias_guid = $fiasGuid; // phpcs:ignore

		return $this;
	}

	/**
	 * 7. Почтовый индекс
	 *
	 * @param   integer  $postalCode  Postal code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPostalCode(int $postalCode): self
	{
		$this->postal_code = $postalCode;  // phpcs:ignore

		return $this;
	}

	/**
	 * 8. Код населенного пункта СДЭК
	 *
	 * @param   int  $code  Code
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
	 * 9. Название населенного пункта. Должно соответствовать полностью
	 *
	 * @param   string  $city  City
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCity(string $city): self
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * 10. Ограничение выборки результата. По умолчанию 1000
	 *
	 * @param   integer|null  $size  Size
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setSize(?int $size): self
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * 11. Номер страницы выборки результата. По умолчанию 0
	 *
	 * @param   int|null $page Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPage(?int $page): self
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * 12. Язык локализации ответа
	 *
	 * @param   string  $lang  Lang
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setLang(string $lang = 'rus'): self
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * 13. Ограничение на сумму наложенного платежа:
	 *     -1 - ограничения нет;
	 *      0 - наложенный платеж не принимается;
	 *
	 * @param   float|null  $paymentLimit  Ограничение на сумму наложенного платежа:
	 *                                     -1 - ограничения нет;
	 *                                     0 - наложенный платеж не принимается;
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPaymentLimit(?float $paymentLimit): self
	{
		$this->payment_limit = $paymentLimit; // phpcs:ignore

		return $this;
	}
}
