<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

/**
 * @since 1.0.0
 */
class RescheduledCallResponse extends Source
{
	/**
	 * Информация о неуспешных прозвонах (недозвонах).
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * Дата, на которую согласован повторный прозвон
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_next; // phpcs:ignore

	/**
	 * Время, на которое согласован повторный прозвон
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $time_next; // phpcs:ignore

	/**
	 * Комментарий к переносу прозвона
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $comment = null; // phpcs:ignore

	/**
	 * Получить параметр - информация о неуспешных прозвонах (недозвонах).
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
	 * Дата, на которую согласован повторный прозвон
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
	 * Время, на которое согласован повторный прозвон
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
	 * Комментарий к переносу прозвона
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getComment(): ?string
	{
		return $this->comment;
	}
}
