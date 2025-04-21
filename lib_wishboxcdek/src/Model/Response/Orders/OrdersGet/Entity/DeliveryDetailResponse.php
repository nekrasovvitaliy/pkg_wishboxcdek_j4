<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class DeliveryDetailResponse extends AbstractResponse
{
	/**
	 * 1.28.1. Дата доставки
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $date = null;

	/**
	 * 1.28.2. Получатель при доставке
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
    protected ?string $recipient_name = null; // phpcs:ignore

	/**
	 * 1.28.3. Сумма наложенного платежа, которую взяли с получателя, в валюте страны получателя с учетом частичной доставки
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $payment_sum; // phpcs:ignore

	/**
	 * @var array - Тип оплаты наложенного платежа получателем
	 *
	 * @since 1.0.0
	 */
	protected array $payment_info; // phpcs:ignore

	/**
	 * @var float $delivery_sum
	 *
	 * @since 1.0.0
	 */
	protected float $delivery_sum; // phpcs:ignore

	/**
	 * 1.28.1. Дата доставки
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDate(): ?string
	{
		return $this->date;
	}

	/**
	 * 1.28.2. Получатель при доставке
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getRecipientName(): ?string
	{
		return $this->recipient_name; // phpcs:ignore
	}

	/**
	 * 1.28.3. Сумма наложенного платежа, которую взяли с получателя, в валюте страны получателя с учетом частичной доставки
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getPaymentSum(): float
	{
		return $this->payment_sum; // phpcs:ignore
	}

	/**
	 * Получает параметр - payment_info.
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getPaymentInfo(): array
	{
		return $this->payment_info; // phpcs:ignore
	}

	/**
	 * @return float
	 *
	 * @retun float
	 *
	 * @since 1.0.0
	 */
	public function getDeliverySum(): float
	{
		return $this->delivery_sum; // phpcs:ignore
	}
}
