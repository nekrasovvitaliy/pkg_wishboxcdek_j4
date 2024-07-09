<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\CallsResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\DeliveryDetailResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\DeliveryProblemResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\PackageResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\RecipientResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\SellerResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\SenderResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\ServiceResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\MoneyResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\LocationResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\ThresholdResponse;

/**
 * @since 1.0.0
 */
class Entity extends AbstractResponse
{
	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid; // phpcs:ignore

	/**
	 * Признак возвратного заказа:
	 * true - возвратный
	 * false - прямой
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_return; // phpcs:ignore

	/**
	 * Признак реверсного заказа:
	 * true - реверсный
	 * false - не реверсный
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $is_reverse; // phpcs:ignore

	/**
	 * Признак клиентского возврата
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $is_client_return; // phpcs:ignore

	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $additional_order_types = null; // phpcs:ignore

	/**
	 * Номер заказа СДЭК
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $cdek_number = null; // phpcs:ignore

	/**
	 * Номер заказа в ИС Клиента.
	 *
	 * При запросе информации по данному полю возможны варианты:
	 * - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
	 * - если найдено больше 1, то выбирается созданный с самой последней датой.
	 *
	 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $number = null;

	/**
	 * 1.9 Истинный режим заказа:
	 *
	 * 1 - дверь-дверь
	 * 2 - дверь-склад
	 * 3 - склад-дверь
	 * 4 - склад-склад
	 * 6 - дверь-постамат
	 * 7 - склад-постамат
	 * 8 - постамат-дверь
	 * 9 - постамат-склад
	 * 10 - постамат-постамат
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $delivery_mode = null; // phpcs:ignore

	/**
	 * Код тарифа
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $tariff_code; // phpcs:ignore

	/**
	 * Комментарий к заказу
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $comment = null;

	/**
	 * Ключ разработчика (для разработчиков модулей)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $developer_key = null; // phpcs:ignore

	/**
	 * Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipment_point = null; // phpcs:ignore

	/**
	 * Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $delivery_point = null; // phpcs:ignore

	/**
	 * Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date_invoice = null; // phpcs:ignore

	/**
	 * Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_name = null; // phpcs:ignore

	/**
	 * Адрес грузоотправителя
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_address = null; // phpcs:ignore

	/**
	 * 1.18. Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @var MoneyResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?MoneyResponse $delivery_recipient_cost = null; // phpcs:ignore

	/**
	 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @var ThresholdResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $delivery_recipient_cost_adv = []; // phpcs:ignore

	/**
	 * 1.20. Отправитель
	 *
	 * @var SenderResponse
	 *
	 * @since 1.0.0
	 */
	protected SenderResponse $sender;

	/**
	 * Реквизиты истинного продавца
	 *
	 * @var SellerResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?SellerResponse $seller; // phpcs:ignore

	/**
	 * Получатель
	 *
	 * @var RecipientResponse
	 *
	 * @since 1.0.0
	 */
	protected RecipientResponse $recipient; // phpcs:ignore

	/**
	 * Адрес отправления
	 *
	 * @var LocationResponse
	 *
	 * @since 1.0.0
	 */
	protected LocationResponse $from_location; // phpcs:ignore

	/**
	 * Адрес получения
	 *
	 * @var LocationResponse
	 *
	 * @since 1.0.0
	 */
	protected LocationResponse $to_location; // phpcs:ignore

	/**
	 * 1.25. Дополнительные услуги (подробнее см. приложение 3)
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\ServiceResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $services; // phpcs:ignore

	/**
	 * 1.26. Список информации по местам (упаковкам)
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\PackageResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $packages; // phpcs:ignore

	/**
	 * 1.27. Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\DeliveryProblemResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $delivery_problem; // phpcs:ignore

	/**
	 * 1.28. Информация о вручении
	 *
	 * @var DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?DeliveryDetailResponse $delivery_detail = null; // phpcs:ignore

	/**
	 * 1.29. Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $transacted_payment = null; // phpcs:ignore

	/**
	 * 1.30. Список статусов по заказу, отсортированных по дате и времени
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\StatusResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $statuses;

	/**
	 * 1.31. Информация о прозвонах получателя
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\CallsResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?CallsResponse $cals; // phpcs:ignore

	/**
	 * 1.32. Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $planned_delivery_date; // phpcs:ignore

	/**
	 * 1.33. Срок бесплатного хранения заказа на складе
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $keep_free_until; // phpcs:ignore

	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getUuid(): string
	{
		return $this->uuid; // phpcs:ignore
	}

	/**
	 * Признак возвратного заказа:
	 * true - возвратный
	 * false - прямой
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function getIsReturn(): bool
	{
		return $this->is_return; // phpcs:ignore
	}

	/**
	 * Признак реверсного заказа:
	 * true - реверсный
	 * false - не реверсный
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getIsReverse(): string
	{
		return $this->is_reverse; // phpcs:ignore
	}

	/**
	 * Признак клиентского возврата
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getIsClientReturn(): string
	{
		return $this->is_client_return; // phpcs:ignore
	}

	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 */
	public function getAdditionalOrderTypes(): ?int
	{
		return $this->additional_order_types; // phpcs:ignore
	}

	/**
	 * Номер заказа СДЭК
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getCdekNumber(): ?string
	{
		return $this->cdek_number; // phpcs:ignore
	}

	/**
	 * Номер заказа в ИС Клиента.
	 *
	 * При запросе информации по данному полю возможны варианты:
	 * - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
	 * - если найдено больше 1, то выбирается созданный с самой последней датой.
	 *
	 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getNumber(): ?string
	{
		return $this->number;
	}

	/**
	 * 1.9 Истинный режим заказа:
	 *
	 * 1 - дверь-дверь
	 * 2 - дверь-склад
	 * 3 - склад-дверь
	 * 4 - склад-склад
	 * 6 - дверь-постамат
	 * 7 - склад-постамат
	 * 8 - постамат-дверь
	 * 9 - постамат-склад
	 * 10 - постамат-постамат
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryMode(): ?string
	{
		return $this->delivery_mode; // phpcs:ignore
	}

	/**
	 * 1.10. Код тарифа
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getTariffCode(): int
	{
		return $this->tariff_code; // phpcs:ignore
	}

	/**
	 * 1.11. Комментарий к заказу
	 *
	 * Для заказов с тарифами Блиц 01-04, в этом поле можно передать желаемый интервал доставки заказа в формате
	 * YYYY-MM-DDThh:mm±hh;YYYY-MM-DDThh:mm±hh. Иначе по умолчанию будет выбран ближайший интервал к текущему времени.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getComment(): ?string
	{
		return $this->comment;
	}

	/**
	 * 1.12. Ключ разработчика (для разработчиков модулей)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeveloperKey(): ?string
	{
		return $this->developer_key; // phpcs:ignore
	}

	/**
	 * 1.13. Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipmentPoint(): ?string
	{
		return $this->shipment_point; // phpcs:ignore
	}

	/**
	 * 1.14. Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryPoint(): ?string
	{
		return $this->delivery_point; // phpcs:ignore
	}

	/**
	 * 1.15. Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDateInvoice(): ?string
	{
		return $this->date_invoice; // phpcs:ignore
	}

	/**
	 * 1.16. Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipperName(): ?string
	{
		return $this->shipper_name; // phpcs:ignore
	}

	/**
	 * 1.17. Адрес грузоотправителя
	 *
	 * Только для международных заказов
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getShipperAddress(): ?string
	{
		return $this->shipper_address; // phpcs:ignore
	}

	/**
	 * 1.18. Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @return MoneyResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryRecipientCost(): ?MoneyResponse
	{
		return $this->delivery_recipient_cost; // phpcs:ignore
	}

	/**
	 * Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @return ThresholdResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryRecipientCostAdv(): array
	{
		return $this->delivery_recipient_cost_adv; // phpcs:ignore
	}

	/**
	 * 1.20. Отправитель
	 *
	 * @return SenderResponse
	 *
	 * @since 1.0.0
	 */
	public function getSender(): SenderResponse
	{
		return $this->sender; // phpcs:ignore
	}

	/**
	 * Реквизиты истинного продавца
	 *
	 * @return SellerResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getSeller(): ?SellerResponse
	{
		return $this->seller; // phpcs:ignore
	}

	/**
	 * 1.22. Получатель
	 *
	 * @return RecipientResponse
	 *
	 * @since 1.0.0
	 */
	public function getRecipient(): RecipientResponse
	{
		return $this->recipient;
	}

	/**
	 * Адрес отправления
	 *
	 * @return LocationResponse
	 *
	 * @since 1.0.0
	 */
	public function getFromLocation(): LocationResponse
	{
		return $this->from_location; // phpcs:ignore
	}

	/**
	 * Адрес получения
	 *
	 * @return LocationResponse
	 *
	 * @since 1.0.0
	 */
	public function getToLocation(): LocationResponse
	{
		return $this->to_location; // phpcs:ignore
	}

	/**
	 * 1.25. Дополнительные услуги (подробнее см. приложение 3)
	 *
	 * @return ServiceResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getServices(): array
	{
		return $this->services; // phpcs:ignore
	}

	/**
	 * 1.26. Список информации по местам (упаковкам)
	 *
	 * @return PackageResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getPackages(): array
	{
		return $this->packages;
	}

	/**
	 * Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
	 *
	 * @return DeliveryProblemResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryProblem(): array
	{
		return $this->delivery_problem; // phpcs:ignore
	}

	/**
	 * Информация о вручении
	 *
	 * @return DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryDetail(): ?DeliveryDetailResponse
	{
		return $this->delivery_detail; // phpcs:ignore
	}

	/**
	 * Признак того, что по заказу была получена информация о переводе наложенного платежа интернет-магазину
	 *
	 * @return DeliveryDetailResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getTransactedPaymentOptional(): ?bool
	{
		return $this->transacted_payment; // phpcs:ignore
	}

	/**
	 * Информация о прозвонах получателя
	 *
	 * @return CallsResponse
	 *
	 * @since 1.0.0
	 */
	public function getCalls(): CallsResponse
	{
		return $this->cals; // phpcs:ignore
	}

	/**
	 * Плановая дата доставки. Передаётся при приёмке груза на склад
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getPlannedDeliveryDate(): ?string
	{
		return $this->planned_delivery_date; // phpcs:ignore
	}

	/**
	 * Срок бесплатного хранения заказа на складе
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getKeepFreeUntil(): ?string
	{
		return $this->keep_free_until; // phpcs:ignore
	}
}
