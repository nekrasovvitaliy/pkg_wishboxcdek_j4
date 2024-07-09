<?php
/**
 * @copyright   (с) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders;

use WishboxCdekSDK2\Entity\Responses\PackageResponse;
use WishboxCdekSDK2\Model\Request\AbstractRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ContactRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\MoneyRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ThresholdRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\FromLocationRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\SellerRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ServiceRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatch\ToLocationRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrdersPatchRequest extends AbstractRequest
{
	/**
	 * 1. Идентификатор заказа в ИС СДЭК, который нужно изменить
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $uuid = null;

	/**
	 * 2. Номер заказа СДЭК, который нужно изменить
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $cdekNumber = null;

	/**
	 * 4. Код тарифа
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $tariff_code; // phpcs:ignore

	/**
	 * 5. Комментарий к заказу
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $comment = null;

	/**
	 * 6. Ключ разработчика (для разработчиков модулей)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $developer_key = null; // phpcs:ignore

	/**
	 * 7. Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipment_point = null; // phpcs:ignore

	/**
	 * 8. Код офиса СДЭК (ПВЗ/постамат), на который будет доставлена посылка
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $delivery_point = null; // phpcs:ignore

	/**
	 * 9. Дата инвойса
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date_invoice = null; // phpcs:ignore

	/**
	 * 10. Грузоотправитель
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_name = null; // phpcs:ignore

	/**
	 * 11. Адрес грузоотправителя
	 *
	 * Только для международных заказов
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $shipper_address = null; // phpcs:ignore

	/**
	 * 12. Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @var MoneyRequest|null
	 *
	 * @since 1.0.0
	 */
	protected ?MoneyRequest $delivery_recipient_cost = null; // phpcs:ignore

	/**
	 * 13. Доп. сбор за доставку (которую ИМ берет с получателя), в зависимости от суммы заказа
	 *
	 * @var ThresholdRequest[]
	 *
	 * @since 1.0.0
	 */
	protected array $delivery_recipient_cost_adv = []; // phpcs:ignore

	/**
	 * 14. Отправитель
	 *
	 * @var ContactRequest|null
	 *
	 * @since 1.0.0
	 */
	protected ?ContactRequest $sender = null;

	/**
	 * 15. Реквизиты истинного продавца
	 *
	 * @var SellerRequest|null
	 *
	 * @since 1.0.0
	 */
	protected ?SellerRequest $seller;

	/**
	 * 16. Получатель
	 *
	 * @var ContactRequest
	 *
	 * @since 1.0.0
	 */
	protected ContactRequest $recipient; // phpcs:ignore

	/**
	 * Адрес отправления
	 *
	 * @var FromLocationRequest
	 *
	 * @since 1.0.0
	 */
	protected FromLocationRequest $from_location; // phpcs:ignore

	/**
	 * Адрес получения
	 *
	 * @var ToLocationRequest
	 *
	 * @since 1.0.0
	 */
	protected ToLocationRequest $to_location; // phpcs:ignore

	/**
	 * Адрес получения
	 *
	 * @var ServiceRequest[]
	 *
	 * @since 1.0.0
	 */
	protected array $services; // phpcs:ignore

	/**
	 * Список информации по местам (упаковкам)
	 *
	 * @var PackageResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $packages; // phpcs:ignore

	/**
	 * 21. Необходимость сформировать печатную форму по заказу
	 *
	 *  Может принимать значения:
	 *  barcode - ШК мест (число копий - 1)
	 *  waybill - квитанция (число копий - 2)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $print = null;

	/**
	 * 22. Признак клиентского возврата
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $is_client_return = null; // phpcs:ignore

	/**
	 * 1. Идентификатор заказа в ИС СДЭК, который нужно изменить
	 *
	 * @param   string|null  $uuid  Идентификатор заказа в ИС СДЭК, который нужно изменить
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setUuid(?string $uuid): self
	{
		$this->uuid = $uuid;

		return $this;
	}

	/**
	 * 2. Номер заказа СДЭК, который нужно изменить
	 *
	 * @param   string|null  $cdekNumber  Номер заказа в ИС Клиента
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCdekNumber(?string $cdekNumber): self
	{
		$this->cdekNumber = $cdekNumber;

		return $this;
	}

	/**
	 * 4. Код тарифа (подробнее см. приложение 1)
	 *
	 * @param   integer  $tariffCode  Код тарифа (подробнее см. приложение 1)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setTariffCode(int $tariffCode): self
	{
		$this->tariff_code = $tariffCode; // phpcs:ignore

		return $this;
	}

	/**
	 * 5. Комментарий к заказу
	 *
	 * @param   string|null  $comment  Комментарий к заказу
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setComment(?string $comment): self
	{
		$this->comment = $comment;

		return $this;
	}

	/**
	 * 6. Ключ разработчика (для разработчиков модулей)
	 *
	 * @param   string|null  $developerKey  Ключ разработчика (для разработчиков модулей)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDeveloperKey(?string $developerKey): self
	{
		$this->developer_key = $developerKey; // phpcs:ignore

		return $this;
	}

	/**
	 * 7. Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * Не может использоваться одновременно с from_location
	 *
	 * @param   string|null  $shipmentPoint  Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setShipmentPoint(?string $shipmentPoint): self
	{
		$this->shipment_point = $shipmentPoint; // phpcs:ignore

		return $this;
	}

	/**
	 * Код офиса СДЭК (ПВЗ/постамата), на который будет доставлена посылка
	 *
	 * Не может использоваться одновременно с to_location
	 * (если офис недоступен, то происходит переадресация на ближайший доступный офис5)
	 *
	 * @param   string|null  $deliveryPoint  Код офиса СДЭК (ПВЗ/постамата), на который будет доставлена посылка
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDeliveryPoint(?string $deliveryPoint): self
	{
		$this->delivery_point = $deliveryPoint; // phpcs:ignore

		return $this;
	}

	/**
	 * 9. Дата инвойса
	 *
	 * Только для международных заказов с типом "интернет-магазин". Если поле заполнено, то заказ автоматически становится международным.
	 *
	 * @param   string|null  $dateInvoice  Дата инвойса
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDateInvoice(?string $dateInvoice): self
	{
		$this->date_invoice = $dateInvoice; // phpcs:ignore

		return $this;
	}

	/**
	 * 10. Грузоотправитель
	 *
	 * Только для международных заказов с типом "интернет-магазин". Если поле заполнено, то заказ автоматически становится международным.
	 *
	 * @param   string|null  $shipperName  Грузоотправитель
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setShipperName(?string $shipperName): self
	{
		$this->shipper_name = $shipperName; // phpcs:ignore

		return $this;
	}

	/**
	 * Адрес грузоотправителя
	 *
	 * Только для международных заказов с типом "интернет-магазин". Если поле заполнено, то заказ автоматически становится международным.
	 *
	 * @param   string|null  $shipperAddress  Адрес грузоотправителя
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setShipperAddress(?string $shipperAddress): self
	{
		$this->shipper_address = $shipperAddress; // phpcs:ignore

		return $this;
	}

	/**
	 * 12. Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * Только для заказов "интернет-магазин". Для направлений Беларусь-Беларусь и РФ-Беларусь, это поле игнорируется .
	 *
	 * @param   MoneyRequest|null  $deliveryRecipientCost  Доп. сбор за доставку, которую ИМ берет с получателя.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDeliveryRecipientCost(?MoneyRequest $deliveryRecipientCost): self
	{
		$this->delivery_recipient_cost = $deliveryRecipientCost; // phpcs:ignore

		return $this;
	}

	/**
	 * 13. Доп. сбор за доставку (которую ИМ берет с получателя) в зависимости от суммы заказа
	 *
	 * Только для заказов "интернет-магазин". Возможно указать несколько порогов.
	 *
	 * @param   ThresholdRequest[]  $deliveryRecipientCostAdv  Доп. сбор за доставку (которую ИМ берет с получателя)
	 *                                                         в зависимости от суммы заказа
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDeliveryRecipientCostAdv(array $deliveryRecipientCostAdv): self
	{
		$this->delivery_recipient_cost_adv = $deliveryRecipientCostAdv; // phpcs:ignore

		return $this;
	}

	/**
	 * 14. Отправитель
	 *
	 * @param   ContactRequest|null  $sender  Отправитель
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setSender(?ContactRequest $sender): self
	{
		$this->sender = $sender;

		return $this;
	}

	/**
	 * 15. Реквизиты истинного продавца
	 *
	 * Только для заказов "интернет-магазин"
	 *
	 * @param   SellerRequest|null  $seller  Реквизиты истинного продавца
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setSeller(?SellerRequest $seller): self
	{
		$this->seller = $seller;

		return $this;
	}

	/**
	 * 16. Получатель
	 *
	 * @param   ContactRequest  $recipient  Получатель
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setRecipient(ContactRequest $recipient): self
	{
		$this->recipient = $recipient; // phpcs:ignore

		return $this;
	}

	/**
	 * 17. Адрес отправления
	 *
	 * Не может использоваться одновременно с shipment_point
	 *
	 * @param   FromLocationRequest  $fromLocation  Адрес отправления
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setFromLocation(FromLocationRequest $fromLocation): self
	{
		$this->from_location = $fromLocation; // phpcs:ignore

		return $this;
	}

	/**
	 * Адрес получения
	 *
	 * @param   ToLocationRequest  $toLocation  Адрес получения
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setToLocation(ToLocationRequest $toLocation): self
	{
		$this->to_location = $toLocation; // phpcs:ignore

		return $this;
	}

	/**
	 * Услуги
	 *
	 * @param   ServiceRequest[]  $services  Услуги
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setServices(array $services): self
	{
		$this->services = $services; // phpcs:ignore

		return $this;
	}

	/**
	 * Список информации по местам (упаковкам)
	 *
	 * @param   PackageResponse[]  $packages  Список информации по местам (упаковкам)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPackages(array $packages): self
	{
		$this->packages = $packages; // phpcs:ignore

		return $this;
	}

	/**
	 * Необходимость сформировать печатную форму по заказу
	 *
	 * @param   string|null   $print  Необходимость сформировать печатную форму по заказу
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPrint(?string $print): self
	{
		$this->print = $print;

		return $this;
	}

	/**
	 * Признак клиентского возврата
	 *
	 * @param   string|null  $isClientReturn  Признак клиентского возврата
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setIsClientReturn(?string $isClientReturn): self
	{
		$this->is_client_return = $isClientReturn; // phpcs:ignore

		return $this;
	}
}
