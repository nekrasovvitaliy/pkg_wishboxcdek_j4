<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\DeliveryPoints;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class DeliveryPointsGetRequest extends AbstractRequest
{
	/**
	 * 1. Почтовый индекс города, для которого необходим список офисов
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $postal_code = null; // phpcs:ignore

	/**
	 * 2. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $city_code = null; // phpcs:ignore

	/**
	 * 3. Тип офиса, может принимать значения:
	 *    «PVZ» - для отображения складов СДЭК;
	 *    «POSTAMAT» - для отображения постаматов СДЭК;
	 *    «ALL» - для отображения всех ПВЗ независимо от их типа.
	 *
	 * При отсутствии параметра принимается значение по умолчанию «ALL».
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $type = null;

	/**
	 * 4. Код страны в формате ISO_3166-1_alpha-2 (см. “Общероссийский классификатор стран мира”)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_code = null; // phpcs:ignore

	/**
	 * 5. Код региона по базе СДЭК
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $region_code = null; // phpcs:ignore

	/**
	 * 6. Наличие терминала оплаты
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $have_cashless = null; // phpcs:ignore

	/**
	 * 7. Есть прием наличных
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $have_cash = null; // phpcs:ignore

	/**
	 * 8. Разрешен наложенный платеж в ПВЗ
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $allowed_cod = null; // phpcs:ignore

	/**
	 * 9. Есть ли примерочная
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $is_dressing_room = null; // phpcs:ignore

	/**
	 * 10. Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $weight_max = null; // phpcs:ignore

	/**
	 * 11. Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $weight_min = null; // phpcs:ignore

	/**
	 * 12. Локализация по умолчанию 'rus'.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $lang = null;

	/**
	 * 13. Является ли офис только пунктом выдачи
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $take_only = null; // phpcs:ignore

	/**
	 * 14. Является пунктом выдачи
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $is_handout = null; // phpcs:ignore

	/**
	 * 15. Есть ли в офисе приём заказов, может
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $is_reception = null; // phpcs:ignore

	/**
	 * 16. Код города ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * 17. Код ПВЗ
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $code = null;

	/**
	 * 18. Работает ли офис с LTL (сборный груз)
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $is_ltl = null; // phpcs:ignore

	/**
	 * 19. Работает ли офис с "Фулфилмент. Приход"
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $fulfillment = null;

	/**
	 * 20. Ограничение выборки результата. По умолчанию 1000
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $size = null;

	/**
	 * 21. Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $page = null;

	/**
	 * 1. Почтовый индекс города, для которого необходим список офисов
	 *
	 * @param   integer|null  $postalCode  Почтовый индекс города, для которого необходим список офисов
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPostalCode(?int $postalCode): self
	{
		$this->postal_code = $postalCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 2. Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @param   integer|null  $cityCode  Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCityCode(?int $cityCode): self
	{
		$this->city_code = $cityCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 3. Тип офиса, может принимать значения:
	 *    «PVZ» - для отображения складов СДЭК;
	 *    «POSTAMAT» - для отображения постаматов СДЭК;
	 *    «ALL» - для отображения всех ПВЗ независимо от их типа.
	 *
	 * При отсутствии параметра принимается значение по умолчанию «ALL».
	 *
	 * @param   string|null  $type  Тип офиса
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setType(?string $type): self
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * 4. Код страны в формате ISO_3166-1_alpha-2 (см. “Общероссийский классификатор стран мира”)
	 *
	 * @param   string|null $countryCode  Код страны в формате ISO_3166-1_alpha-2 (см. “Общероссийский классификатор стран мира”)
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
	 * 5. Код региона по базе СДЭК
	 *
	 * @param   integer|null  $regionCode  Код региона по базе СДЭК
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setRegionCode(?int $regionCode): self
	{
		$this->region_code = $regionCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 6. Наличие терминала оплаты
	 *
	 * @param   boolean|null  $haveCashless  Наличие терминала оплаты
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setHaveCashless(?bool $haveCashless): self
	{
		$this->have_cashless = $haveCashless; // phpcs:ignore

		return $this;
	}

	/**
	 * 7. Есть прием наличных
	 *
	 * @param   boolean|null  $haveCash  Есть прием наличных
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setHaveCash(?bool $haveCash): self
	{
		$this->have_cash = $haveCash; // phpcs:ignore

		return $this;
	}

	/**
	 * 8. Разрешен наложенный платеж в ПВЗ
	 *
	 * @param   boolean|null  $allowedCod  Разрешен наложенный платеж в ПВЗ
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAllowedCod(?bool $allowedCod): self
	{
		$this->allowed_cod = $allowedCod; // phpcs:ignore

		return $this;
	}

	/**
	 * 9. Есть ли примерочная
	 *
	 * @param   boolean|null  $isDressingRoom  Есть ли примерочная
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setIsDressingRoom(?bool $isDressingRoom): self
	{
		$this->is_dressing_room = $isDressingRoom; // phpcs:ignore

		return $this;
	}

	/**
	 * 10. Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
	 *
	 * @param   float|null $weightMax Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setWeightMax(?float $weightMax): self
	{
		$this->weight_max = $weightMax; // phpcs:ignore

		return $this;
	}

	/**
	 * 11. Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
	 *
	 * @param   float|null  $weightMin  Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setWeightMin(?float $weightMin): self
	{
		$this->weight_min = $weightMin; // phpcs:ignore

		return $this;
	}

	/**
	 * 12. Локализация по умолчанию 'rus'.
	 *
	 * @param   string|null  $lang  Локализация по умолчанию 'rus'.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setLang(?string $lang): self
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * 13. Является ли офис только пунктом выдачи
	 *
	 * @param   boolean|null  $takeOnly  Является ли офис только пунктом выдачи
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setTakeOnly(?bool $takeOnly): self
	{
		$this->take_only = $takeOnly; // phpcs:ignore

		return $this;
	}

	/**
	 * 14. Является пунктом выдачи
	 *
	 * @param   boolean|null  $isHandout  Является пунктом выдачи
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setIsHandout(?bool $isHandout): self
	{
		$this->is_handout = $isHandout; // phpcs:ignore

		return $this;
	}

	/**
	 * 15. Есть ли в офисе приём заказов
	 *
	 * @param   boolean|null  $isReception  Есть ли в офисе приём заказов
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setIsReception(?bool $isReception): self
	{
		$this->is_reception = $isReception; // phpcs:ignore

		return $this;
	}

	/**
	 * 16. Код города ФИАС
	 *
	 * @param   string|null  $fiasGuid  Код города ФИАС
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
	 * 17. Код ПВЗ
	 *
	 * @param   integer|null  $code  Код ПВЗ
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
	 * 18. Работает ли офис с LTL (сборный груз)
	 *
	 * @param   boolean|null  $isLtl  Работает ли офис с LTL (сборный груз)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setIsLtl(?bool $isLtl): self
	{
		$this->is_ltl = $isLtl; // phpcs:ignore

		return $this;
	}

	/**
	 * 19. Работает ли офис с "Фулфилмент. Приход"
	 *
	 * @param   boolean|null  $fulfillment  Работает ли офис с "Фулфилмент. Приход"
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setFulfillment(?bool $fulfillment): self
	{
		$this->fulfillment = $fulfillment;

		return $this;
	}

	/**
	 * 20. Ограничение выборки результата. По умолчанию 1000
	 *
	 * @param   integer|null  $size  Ограничение выборки результата. По умолчанию 1000
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
	 * 21. Номер страницы выборки результата. По умолчанию 0.
	 *
	 * @param   integer|null  $page  Номер страницы выборки результата. По умолчанию 0.
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
}
