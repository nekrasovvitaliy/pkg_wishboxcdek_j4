<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Calls;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class FailedCallResponse extends AbstractResponse
{
	/**
	 * 1.31.1.1. Дата и время создания недозвона
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * 1.31.1.2. Причина недозвона (подробнее см. приложение 5)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $reason_code; // phpcs:ignore

	/**
	 * 1.31.1.1. Дата и время создания недозвона
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
	 * 1.31.1.2. Причина недозвона (подробнее см. приложение 5)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getReasonCode(): string
	{
		return $this->reason_code; // phpcs:ignore
	}
}
