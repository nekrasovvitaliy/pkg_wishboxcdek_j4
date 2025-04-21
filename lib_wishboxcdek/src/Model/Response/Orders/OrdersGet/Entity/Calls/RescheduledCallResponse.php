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
class RescheduledCallResponse extends AbstractResponse
{
	/**
	 * 1.31.2.1. Дата и время создания переноса прозвона
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * 1.31.2.2. Дата, на которую согласован повторный прозвон
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_next; // phpcs:ignore

	/**
	 * 1.31.2.3. Время, на которое согласован повторный прозвон
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $time_next; // phpcs:ignore

	/**
	 * 1.31.2.4. Комментарий к переносу прозвона
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $comment;

	/**
	 * 1.31.2.1. Дата и время создания переноса прозвона
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
	 * 1.31.2.2. Дата, на которую согласован повторный прозвон
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getDateNext(): string
	{
		return $this->date_next; // phpcs:ignore
	}

	/**
	 * 1.31.2.3. Время, на которое согласован повторный прозвон
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getTimeNext(): string
	{
		return $this->time_next; // phpcs:ignore
	}

	/**
	 * 1.31.2.4. Комментарий к переносу прозвона
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getComment(): string
	{
		return $this->comment;
	}
}
