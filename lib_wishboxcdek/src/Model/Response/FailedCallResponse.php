<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

/**
 * @since 1.0.0
 */
class FailedCallResponse extends Source
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
	 * Причина недозвона.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $reason_code; // phpcs:ignore

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
	 * Причина недозвона (подробнее см. приложение 5)
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getReasonCode(): int
	{
		return $this->reason_code; // phpcs:ignore
	}
}
