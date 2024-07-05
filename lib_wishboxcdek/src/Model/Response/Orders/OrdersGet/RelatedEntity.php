<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet;

use WishboxCdekSDK2\Entity\Responses\Source;

/**
 * Связанная с заказом сущность
 *
 * @since 1.0.0
 */
class RelatedEntity extends Source
{
	/**
	 * 3.1 Тип сущности, связанной с заказом
	 *     Может принимать значения:
	 *     return_order - возвратный заказ (возвращается для прямого, если заказ не вручен и по нему уже был сформирован возвратный заказ)
	 *     direct_order - прямой заказ (возвращается для возвратного и реверсного заказа)
	 *     waybill - квитанция к заказу (возвращается для заказа, по которому есть сформированная квитанция)
	 *     barcode - ШК места к заказу (возвращается для заказа, по которому есть сформированный ШК места)
	 *     reverse_order - реверсный заказ (возвращается для прямого заказа, если подключен реверс)
	 *     delivery - актуальная договоренность о доставке
	 *     client_return_order - заказ клиентский возврат (возвращается для прямого заказа, к которому привязан клиентский возврат)
	 *     client_direct_order - прямой заказ, по которому оформлен клиентский возврат
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * 3.2 Идентификатор сущности, связанной с заказом
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid;

	/**
	 * 3.3 Ссылка на скачивание печатной формы в статусе "Сформирован", только для type = waybill, barcode
	 * url может не отображаться, если ссылка на скачивание ПФ еще не сформирована.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $url = null;

	/**
	 * 3.4 Номер заказа СДЭК
	 * Может возвращаться для return_order, direct_order, reverse_order, client_return_order, client_direct_order
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $cdek_number = null; // phpcs:ignore

	/**
	 * 3.5 Дата доставки, согласованная с получателем
	 * Только для типа delivery
	 * (Если заказ "До склада", эта дата не влияет на сроки доставки и может быть произвольной)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date = null;

	/**
	 * 3.6 Время начала ожидания курьера (согласованное с получателем)
	 * Только для типа delivery
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $time_from = null; // phpcs:ignore

	/**
	 * 3.7 Время окончания ожидания курьера (согласованное с получателем)
	 * Только для типа delivery
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $time_to = null; // phpcs:ignore

	/**
	 * 3.8 Дата и время создания сущности, связанной с заказом
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $create_time = null; // phpcs:ignore

	/**
	 * Получить тип сущности, связанной с заказом.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Получить идентификатор сущности, связанной с заказом.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}

	/**
	 * Получить ссылку на скачивание печатной формы.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * Получить номер заказа СДЭК.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getCdekNumber(): ?string
	{
		return $this->cdek_number; // phpcs:ignore
	}

	/**
	 * Получить дату доставки, согласованную с получателем.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getDate(): ?string
	{
		return $this->date;
	}

	/**
	 * Получить время начала ожидания курьера (согласованное с получателем).
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getTimeFrom(): ?string
	{
		return $this->time_from; // phpcs:ignore
	}

	/**
	 * Получить время окончания ожидания курьера (согласованное с получателем).
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getTimeTo(): ?string
	{
		return $this->time_to; // phpcs:ignore
	}

	/**
	 * Получить дату и время создания сущности, связанной с заказом.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnused
	 */
	public function getCreateTime(): ?string
	{
		return $this->create_time; // phpcs:ignore
	}
}
