<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Package;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Package\Item\PaymentResponse;

/**
 * @since 1.0.0
 */
class ItemResponse extends AbstractResponse
{
	/**
	 * 1.26.10.1. Наименование товара (может также содержать описание товара: размер, цвет)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $name;

	/**
	 * 1.26.10.2 Идентификатор/артикул товара
	 *
	 * Артикул товара может содержать только символы:[A-z А-я 0-9 ! @ " # № $ ; % ^ : & ? * () _ - + = ? < > , .{ } [ ] \ / , пробел]
	 * При передаче одинаковых артикулов в рамках одной упаковки, артикул будет заменяться на:
	 * {ware_key}_* , где * – это 7 случайных символов.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $ware_key;  // phpcs:ignore

	/**
	 * 1.26.10.3. Оплата за товар при получении (за единицу товара в валюте страны получателя, значение >=0)
	 * — наложенный платеж, в случае предоплаты значение = 0
	 *
	 * @var PaymentResponse
	 *
	 * @since 1.0.0
	 */
	protected PaymentResponse $payment;

	/**
	 * 1.26.10.4. Объявленная стоимость товара (за единицу товара в валюте взаиморасчетов, значение >=0).
	 * С данного значения рассчитывается страховка
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $cost;

	/**
	 * 1.26.10.5. Вес (за единицу товара, в граммах)
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $weight;

	/**
	 * Вес брутто (только для международных заказов).
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $weight_gross; // phpcs:ignore

	/**
	 * Количество единиц товара.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $amount;

	/**
	 * Количество врученных единиц товара (в штуках).
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $delivery_amount; // phpcs:ignore

	/**
	 * Маркировка товара/вложения.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $marking;

	/**
	 * Наименование на иностранном языке.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $name_i18n; // phpcs:ignore

	/**
	 * Бренд на иностранном языке.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $brand;

	/**
	 * Код страны в формате ISO_3166-1_alpha-2.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $country_code; // phpcs:ignore

	/**
	 * Код материала.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $material;

	/**
	 * Содержит ли радиочастотные модули (wifi/gsm).
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $wifi_gsm; // phpcs:ignore

	/**
	 * Ссылка на сайт интернет-магазина с описанием товара.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $url;

	/**
	 * 1.26.10.16 Информация по товарам в возвратном заказе (только для возвратного заказа)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $return_item_detail; // phpcs:ignore

	/**
	 * 1.26.10.17 Информация по товарам в возвратном заказе (только для возвратного заказа)
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $excise;

	/**
	 * 1.26.10.1. Наименование товара (может также содержать описание товара: размер, цвет)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * 1.26.10.2 Идентификатор/артикул товара
	 *
	 * Артикул товара может содержать только символы:[A-z А-я 0-9 ! @ " # № $ ; % ^ : & ? * () _ - + = ? < > , .{ } [ ] \ / , пробел]
	 * При передаче одинаковых артикулов в рамках одной упаковки, артикул будет заменяться на:
	 * {ware_key}_* , где * – это 7 случайных символов.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWareKey(): string
	{
		return $this->ware_key; // phpcs:ignore
	}

	/**
	 * 1.26.10.3. Оплата за товар при получении (за единицу товара в валюте страны получателя, значение >=0)
	 *  — наложенный платеж, в случае предоплаты значение = 0
	 *
	 * @return PaymentResponse
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPayment(): PaymentResponse
	{
		return $this->payment;
	}

	/**
	 * 1.26.10.4. Объявленная стоимость товара (за единицу товара в валюте взаиморасчетов, значение >=0).
	 *  С данного значения рассчитывается страховка
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCost(): float
	{
		return $this->cost;
	}

	/**
	 * 1.26.10.5. Вес (за единицу товара, в граммах)
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWeight(): int
	{
		return $this->weight;
	}

	/**
	 * Get вес брутто (только для международных заказов).
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWeightGross(): ?int
	{
		return $this->weight_gross; // phpcs:ignore
	}

	/**
	 * Get количество единиц товара.
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * Get количество врученных единиц товара (в штуках).
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDeliveryAmount(): ?int
	{
		return $this->delivery_amount; // phpcs:ignore
	}

	/**
	 * Get маркировка товара/вложения.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getMarking(): ?string
	{
		return $this->marking;
	}

	/**
	 * Get наименование на иностранном языке.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getNameI18n(): ?string
	{
		return $this->name_i18n; // phpcs:ignore
	}

	/**
	 * Get бренд на иностранном языке.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getBrand(): ?string
	{
		return $this->brand;
	}

	/**
	 * Get код страны в формате ISO_3166-1_alpha-2.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCountryCode(): ?string
	{
		return $this->country_code; // phpcs:ignore
	}

	/**
	 * Get код материала.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getMaterial(): ?string
	{
		return $this->material;
	}

	/**
	 * Get содержит ли радиочастотные модули (wifi/gsm).
	 *
	 * @return boolean|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWifiGsm(): ?bool
	{
		return $this->wifi_gsm; // phpcs:ignore
	}

	/**
	 * Get ссылка на сайт интернет-магазина с описанием товара.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * Информация по товарам в возвратном заказе (только для возвратного заказа)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getReturnItemDetail(): ?string
	{
		return $this->return_item_detail; // phpcs:ignore
	}

	/**
	 * Признак подакцизности товара
	 *
	 * @return boolean|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getExcise(): ?bool
	{
		return $this->excise;
	}
}
