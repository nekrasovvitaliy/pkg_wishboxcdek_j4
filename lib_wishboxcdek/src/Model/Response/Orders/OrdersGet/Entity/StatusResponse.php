<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * 1.30. Список статусов по заказу, отсортированных по дате и времени
 *
 * @since 1.0.0
 */
class StatusResponse extends AbstractResponse
{
	/**
	 * 1.30.1. Код статуса (подробнее см. приложение 1)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 1.30.2. Название статуса
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $name;

	/**
	 * 1.30.3. Дата и время установки статуса (формат yyyy-MM-dd'T'HH:mm:ssZ)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * 1.30.4. Дополнительный код статуса (подробнее см. приложение 2)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $reason_code; // phpcs:ignore

	/**
	 * 1.30.5. Наименование места возникновения статуса
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city;

	/**
	 * 1.30.1. Код статуса (подробнее см. приложение 1)
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
	 * 1.30.2. Название статуса
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * 1.30.3. Дата и время установки статуса (формат yyyy-MM-dd'T'HH:mm:ssZ)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getDateTime(): string
	{
		return $this->date_time; // phpcs:ignore
	}

	/**
	 * 1.30.4. Дополнительный код статуса (подробнее см. приложение 2)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getReasonCode(): string
	{
		return $this->reason_code; // phpcs:ignore
	}

	/**
	 * 1.30.5. Наименование места возникновения статуса
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCity(): string
	{
		return $this->city;
	}
}
