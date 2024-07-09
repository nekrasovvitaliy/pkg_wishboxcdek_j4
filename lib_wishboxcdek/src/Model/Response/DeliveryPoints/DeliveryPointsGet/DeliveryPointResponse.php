<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\OfficeImageResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\PhoneResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\WorkTimeExceptionResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\WorkTimeResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\DimensionsResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\ErrorResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\LocationResponse;

/**
 * Список действующих офисов СДЭК.
 *
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class DeliveryPointResponse extends AbstractResponse
{
	/**
	 * 1. Код
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 3. Идентификатор офиса в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid;

	/**
	 * 4. Адрес офиса
	 *
	 * @var \WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\LocationResponse
	 *
	 * @since 1.0.0
	 */
	protected LocationResponse $location;

	/**
	 * 5. Описание местоположения.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address_comment; // phpcs:ignore

	/**
	 * 6. Ближайшая станция/остановка транспорта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $nearest_station = null; // phpcs:ignore

	/**
	 * 7. Ближайшая станция метро.
	 * По документации string(50), но по факту есть строка на 80
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $nearest_metro_station = null; // phpcs:ignore

	/**
	 * 8. Режим работы, строка вида «пн-пт 9-18, сб 9-16».
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $work_time; // phpcs:ignore

	/**
	 * 9. Номера телефона.
	 *
	 * @var \WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\PhoneResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $phones;

	/**
	 * 10. Адрес электронной почты
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $email = null;

	/**
	 * 11. Примечание по офису
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $note = null;

	/**
	 * 12. Тип пункта выдачи.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * 13. Принадлежность офиса компании:
	 *     CDEK — офис принадлежит компании СДЭК
	 *     Градусы — офис принадлежит компании Градусы
	 *     Телепорт — офис принадлежит компании Телепорт
	 *     Tastamat — офис принадлежит компании Tastamat
	 *     Халва — офис принадлежит компании Халва
	 *     PickPoint — офис принадлежит компании PickPoint
	 *     OmniCDEK — офис принадлежит компании OmniCDEK
	 *     OmniCDEK (franchise) — офис принадлежит компании OmniCDEK (франчайзи)
	 *     OmniCDEK (self-employed) — офис принадлежит компании OmniCDEK (самозанятые)
	 *     "Нет бренда" — офис принадлежит компании без бренда
	 *
	 * Согласно документации обязательный, но по факту нет	 *
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $owner_code = null; // phpcs:ignore

	/**
	 * 14. Является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов.
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $take_only; // phpcs:ignore

	/**
	 * 15. Является пунктом выдачи
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_handout; // phpcs:ignore

	/**
	 * 16. Является пунктом приёма
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_reception; // phpcs:ignore

	/**
	 * 17. Есть ли примерочная
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_dressing_room; // phpcs:ignore

	/**
	 * 18. Есть безналичный расчет
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $have_cashless; // phpcs:ignore

	/**
	 * 19. Есть приём наличных.
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $have_cash; // phpcs:ignore

	/**
	 * 20. Есть безналичный расчёт по СБП
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $have_fast_payment_system; // phpcs:ignore

	/**
	 * 21. Разрешен наложенный платеж в ПВЗ
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $allowed_cod; // phpcs:ignore

	/**
	 * 22. Работает ли офис с LTL (сборный груз)
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_ltl; // phpcs:ignore

	/**
	 * 23. Работает ли офис с "Фулфилмент. Приход"
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $fulfillment;

	/**
	 * 24. Ссылка на данный ПВЗ на сайте СДЭК
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $site = null;

	/**
	 * 25. Все фото офиса (кроме фото как доехать).
	 *
	 * @var \WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\OfficeImageResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $office_image_list = []; // phpcs:ignore

	/**
	 * 26. График работы на неделю.
	 *
	 * @var WorkTimeResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $work_time_list; // phpcs:ignore

	/**
	 * 27. Исключения в графике работы офиса
	 *
	 * @var WorkTimeExceptionResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $work_time_exception_list; // phpcs:ignore

	/**
	 * 28. Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $weight_min = null; // phpcs:ignore

	/**
	 * 29. Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $weight_max = null; // phpcs:ignore

	/**
	 * 30. Перечень максимальных размеров ячеек (только для type = POSTAMAT).
	 *
	 * @var \WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\DimensionsResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $dimensions = null;

	/**
	 * 31. Список ошибок
	 *
	 * @var \WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint\ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $errors = null;

	/**
	 * 1. Код
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * 3. Идентификатор офиса в ИС СДЭК
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}

	/**
	 * 4. Адрес офиса
	 *
	 * @return LocationResponse
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLocation(): LocationResponse
	{
		return $this->location;
	}

	/**
	 * 5. Описание местоположения.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAddressComment(): ?string
	{
		return $this->address_comment; // phpcs:ignore
	}

	/**
	 * 6. Ближайшая станция/остановка транспорта
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getNearestStation(): ?string
	{
		return $this->nearest_station; // phpcs:ignore
	}

	/**
	 * 7. Ближайшая станция метро. По документации string(50), но по факту есть строка на 80
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getNearestMetroStation(): ?string
	{
		return $this->nearest_metro_station; // phpcs:ignore
	}

	/**
	 * 8. Режим работы, строка вида «пн-пт 9-18, сб 9-16».
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWorkTime(): string
	{
		return $this->work_time; // phpcs:ignore
	}

	/**
	 * 9. Номера телефона.
	 *
	 * @return PhoneResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPhones(): array
	{
		return $this->phones;
	}

	/**
	 * 10. Адрес электронной почты
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * 11. Примечание по офису
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getNote(): ?string
	{
		return $this->note;
	}

	/**
	 * 12. Тип пункта выдачи
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * 13. Принадлежность офиса компании
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOwnerCode(): ?string
	{
		return $this->owner_code; // phpcs:ignore
	}

	/**
	 * 14. Является ли офис только пунктом выдачи или также осуществляет приём грузов
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTakeOnly(): bool
	{
		return $this->take_only; // phpcs:ignore
	}

	/**
	 * 15. Является пунктом выдачи
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getIsHandout(): bool
	{
		return $this->is_handout; // phpcs:ignore
	}

	/**
	 * 16. Является пунктом приёма
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getIsReception(): bool
	{
		return $this->is_reception; // phpcs:ignore
	}

	/**
	 * 17. Есть ли примерочная
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getIsDressingRoom(): bool
	{
		return $this->is_dressing_room; // phpcs:ignore
	}

	/**
	 * 18. Есть безналичный расче
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getHaveCashless(): bool
	{
		return $this->have_cashless; // phpcs:ignore
	}

	/**
	 * 19. Есть приём наличных
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getHaveCash(): bool
	{
		return $this->have_cash; // phpcs:ignore
	}

	/**
	 * 20. Есть безналичный расчёт по СБП
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getHaveFastPaymentSystem(): bool
	{
		return $this->have_fast_payment_system; // phpcs:ignore
	}

	/**
	 * 21. Разрешен наложенный платеж в ПВЗ
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAllowedCod(): bool
	{
		return $this->allowed_cod; // phpcs:ignore
	}

	/**
	 * 22. Работает ли офис с LTL (сборный груз)
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getIsLtl(): bool
	{
		return $this->is_ltl; // phpcs:ignore
	}

	/**
	 * 23. Работает ли офис с "Фулфилмент. Приход"
	 *
	 * @return boolean|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getFulfillment(): ?bool
	{
		return $this->fulfillment;
	}

	/**
	 * 24. Ссылка на данный ПВЗ на сайте СДЭК
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getSite(): ?string
	{
		return $this->site;
	}

	/**
	 * 25. Все фото офиса.
	 *
	 * @return OfficeImageResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOfficeImageList(): array
	{
		return $this->office_image_list; // phpcs:ignore
	}

	/**
	 * 26. График работы на неделю.
	 *
	 * @return WorkTimeResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWorkTimeList(): array
	{
		return $this->work_time_list; // phpcs:ignore
	}

	/**
	 * 27. Исключения в графике работы офиса
	 *
	 * @return WorkTimeExceptionResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWorkTimeExceptionList(): array
	{
		return $this->work_time_exception_list; // phpcs:ignore
	}

	/**
	 * 28. Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWeightMin(): ?float
	{
		return $this->weight_min; // phpcs:ignore
	}

	/**
	 * 29. Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWeightMax(): ?float
	{
		return $this->weight_max; // phpcs:ignore
	}

	/**
	 * 30. Перечень максимальных размеров ячеек (только для type = POSTAMAT).
	 *
	 * @return DimensionsResponse[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDimensions(): ?array
	{
		return $this->dimensions;
	}

	/**
	 * 31. Список ошибок
	 *
	 * @return ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getErrors(): ?array
	{
		return $this->dimensions;
	}
}
