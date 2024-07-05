<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

/**
 * @since 1.0.0
 */
class DeliveryDetailResponse extends Source
{
	/**
	 * @var float $delivery_sum Стоимость услуги доставки (по тарифу)
	 *
	 * @since 1.0.0
	 */
	protected $delivery_sum; // phpcs:ignore

    /**
	 * @var string - Дата доставки
	 *
	 * @since 1.0.0
	 */
    protected $date;

    /**
	 * @var string - Получатель при доставке
	 *
	 * @since 1.0.0
	 */
    protected $recipient_name; // phpcs:ignore

    /**
	 * @var float - Сумма наложенного платежа, которую взяли с получателя, в валюте страны получателя с учетом частичной доставки
	 *
	 * @since 1.0.0
	 */
    protected $payment_sum;

    /**
	 * @var array - Тип оплаты наложенного платежа получателем
	 *
	 * @since 1.0.0
	 */
    protected $payment_info;

    /**
     * Получает параметр - date.
	 *
	 * @since 1.0.0
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Получает параметр - recipient_name.
	 *
	 * @since 1.0.0
     */
    public function getRecipientName()
    {
        return $this->recipient_name;
    }

    /**
     * Получает параметр - payment_sum.
	 *
	 * @since 1.0.0
     */
    public function getPaymentSum()
    {
        return $this->payment_sum;
    }

    /**
     * Получает параметр - payment_info.
	 *
	 * @since 1.0.0
     */
    public function getPaymentInfo()
    {
        return $this->payment_info;
    }

	/**
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getDeliverySum(): float
	{
		return $this->delivery_sum;
	}
}
