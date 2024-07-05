<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

/**
 * Class Invoices квитанции к заказу.
 *
 * @since 1.0.0
 */
class Invoice extends Source
{
	/**
	 * Список заказов.
	 *
	 * @var Order[]
	 *
	 * @since 1.0.0
	 */
	protected $orders;

	/**
	 * Число копий. По умолчанию 1.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected $copy_count;

	/**
	 * Число копий. По умолчанию 1.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected $type;

	/**
	 * Установить параметр - список заказов.
	 *
	 * @param   Order  $orders  Список заказов
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setOrders(Order $orders): self
	{
		$this->orders = $orders;

		return $this;
	}

	/**
	 * Установить параметр - число копий. По умолчанию 1.
	 *
	 * @param   int $copy_count Число копий. По умолчанию 1
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCopyCount(int $copy_count = 1): self
	{
		$this->copy_count = $copy_count;

		return $this;
	}

	/**
	 * Установить параметр - Форма квитанции.
	 *
	 * @param   string $type форма квитанции
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setType(string $type): self
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Экспресс-метод установки адреса.
	 *
	 * @param   array|string $orders_uuid - массив с orders_uuid или один uuid строкой
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withOrdersUuid($orders_uuid): self
	{
		$instance = new static();

		if (is_array($orders_uuid))
		{
			foreach ($orders_uuid as $order_uuid)
			{
				$instance->orders[] = Order::withOrderUuid($order_uuid);
			}
		}
		else
		{
			$instance->orders[] = Order::withOrderUuid($orders_uuid);
		}

		return $instance;
	}

	/**
	 * Экспресс-метод установки адреса.
	 *
	 * @param   array|string $cdek_numbers - массив с orders_uuid или один uuid строкой
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withCdekNumbers($cdek_numbers): self
	{
		$instance = new static();

		if (is_array($cdek_numbers))
		{
			foreach ($cdek_numbers as $cdek_number)
			{
				$instance->orders[] = Order::withCdekNumber($cdek_number);
			}
		}
		else
		{
			$instance->orders[] = Order::withCdekNumber($cdek_numbers);
		}

		return $instance;
	}
}
