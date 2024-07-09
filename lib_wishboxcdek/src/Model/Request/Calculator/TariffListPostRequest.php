<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Calculator;

use WishboxCdekSDK2\Model\Request\AbstractRequest;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPost\LocationRequest;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPost\PackageRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class TariffListPostRequest extends AbstractRequest
{
	/**
	 * 1. Дата и время планируемой передачи заказа
	 *
	 * По умолчанию - текущая
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date = null;

	/**
	 * 2. Тип заказа:
	 *    1 - "интернет-магазин"
	 *    2 - "доставка"
	 *
	 * По умолчанию - 1
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $type = null;

	/**
	 * 3. Дополнительный тип заказа:
	 *
	 * 2 - для сборного груза (LTL)
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 * 10 - для доставки шин по тарифу "Экономичный экспресс"
	 *
	 * @var integer[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $additional_order_types = null; // phpcs:ignore

	/**
	 * 4. Валюта, в которой необходимо произвести расчет (подробнее см. приложение 1)
	 *    По умолчанию - валюта договора
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $currency = null;

	/**
	 * 5. Язык вывода информации о тарифах
	 *
	 * Возможные значения: rus, eng, zho
	 * По умолчанию - rus
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $lang = null;

	/**
	 * 6. Адрес отправления
	 *
	 * @var LocationRequest
	 *
	 * @since 1.0.0
	 */
	protected LocationRequest $from_location; // phpcs:ignore

	/**
	 * 7. Адрес получения
	 *
	 * @var LocationRequest
	 *
	 * @since 1.0.0
	 */
	protected LocationRequest $to_location; // phpcs:ignore

	/**
	 * 8. Список информации по местам (упаковкам)
	 *
	 * @var PackageRequest[]
	 *
	 * @since 1.0.0
	 */
	protected array $packages;

	/**
	 * 1. Дата и время планируемой передачи заказа
	 * По умолчанию - текущая
	 *
	 * @param   string  $date  Дата и время планируемой передачи заказа
	 *                         По умолчанию - текущая
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setDate(string $date): self
	{
		$this->date = $date;

		return $this;
	}

	/**
	 * 2. Тип заказа:
	 * 1 - "интернет-магазин"
	 * 2 - "доставка"
	 * По умолчанию - 1
	 *
	 * @param   integer  $type  Тип заказа (1 - "интернет-магазин", 2 - "доставка")
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setType(int $type): self
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * 3. Дополнительный тип заказа:
	 * 2 - для сборного груза (LTL)
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 * 10 - для доставки шин по тарифу "Экономичный экспресс"
	 *
	 * @param   integer[]|null  $additionalOrderTypes  Дополнительный тип заказа:
	 *                                                 2 - для сборного груза (LTL)
	 *                                                 4 - для Forward
	 *                                                 6 - для "Фулфилмент. Приход"
	 *                                                 7 - для "Фулфилмент. Отгрузка"
	 *                                                 10 - для доставки шин по тарифу "Экономичный экспресс"
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAdditionalOrderTypes(array $additionalOrderTypes): self
	{
		$this->additional_order_types = $additionalOrderTypes; // phpcs:ignore

		return $this;
	}

	/**
	 * 4. Валюта, в которой необходимо произвести расчет (подробнее см. приложение 1)
	 * По умолчанию - валюта договора
	 *
	 * @param   integer|null  $currency  Валюта, в которой необходимо произвести расчет (подробнее см. приложение 1)
	 *                                   По умолчанию - валюта договора
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCurrency(?int $currency): self
	{
		$this->currency = $currency;

		return $this;
	}

	/**
	 * 5. Язык вывода информации о тарифах
	 * Возможные значения: rus, eng, zho
	 * По умолчанию - rus
	 *
	 * @param   string|null  $lang  Язык вывода информации о тарифах
	 *                              Возможные значения: rus, eng, zho
	 *                              По умолчанию - rus
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setLang(?string $lang): self
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * 6. Адрес отправления
	 *
	 * @param   LocationRequest  $fromLocation  Адрес отправления
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setFromLocation(LocationRequest $fromLocation): self
	{
		$this->from_location = $fromLocation; // phpcs:ignore

		return $this;
	}

	/**
	 * 7. Адрес получения
	 *
	 * @param   LocationRequest  $toLocation  Адрес получения
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setToLocation(LocationRequest $toLocation): self
	{
		$this->to_location = $toLocation; // phpcs:ignore

		return $this;
	}

	/**
	 * 8. Список информации по местам (упаковкам)
	 *
	 * @param   PackageRequest[]  $packages  Список информации по местам (упаковкам)
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPackages(array $packages): self
	{
		$this->packages = $packages;

		return $this;
	}

	/**
	 * Экспресс-метод. Устанавливает города отправителя и получателя.
	 *
	 * @param   integer  $from   Код города отправителя
	 * @param   integer  $to     Код города получателя
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCityCodes(int $from, int $to): self
	{
		$this->from_location = (!isset($this->from_location)) // phpcs:ignore
			? LocationRequest::withCode($from)
			: $this->from_location->setCode($from); // phpcs:ignore
		$this->to_location = (!isset($this->to_location)) // phpcs:ignore
			? LocationRequest::withCode($to)
			: $this->to_location->setCode($to); // phpcs:ignore

		return $this;
	}

	/**
	 * Экспресс-метод. Устанавливает индексы городов отправителя и получателя.
	 *
	 * @param   integer  $from Индекс города отправителя
	 * @param   integer  $to   Индекс города получателя
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPostalCodes(int $from, int $to): self
	{
		$this->from_location = $this->from_location->setPostalCode($from); // phpcs:ignore
		$this->to_location = $this->to_location->setPostalCode($to); // phpcs:ignore

		return $this;
	}

	/**
	 * Экспресс-метод. Устанавливает адреса городов отправителя и получателя.
	 *
	 * @param   string $from адрес города отправителя
	 * @param   string $to   адрес города получателя
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAddresses(string $from, string $to): self
	{
		$this->from_location = $this->from_location->setAddress($from); // phpcs:ignore
		$this->to_location = $this->to_location->setAddress($to); // phpcs:ignore

		return $this;
	}

	/**
	 * Экспресс-метод. Устанавливает адреса городов отправителя и получателя.
	 *
	 * @param   string $from адрес города отправителя
	 * @param   string $to   адрес города получателя
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCities(string $from, string $to): self
	{
		$this->from_location = $this->from_location->setCity($from); // phpcs:ignore
		$this->to_location = $this->to_location->setCity($to); // phpcs:ignore

		return $this;
	}

	/**
	 * Экспресс-метод. Создает место с одним обязательным параметром - общий вес (в граммах).
	 *
	 * @param   int $weight Общий вес (в граммах)
	 *
	 * @return self
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPackageWeight(int $weight): self
	{
		$this->packages[] = PackageRequest::withWeight($weight);

		return $this;
	}
}
