<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

/**
 * Class CallsResponse информация о звонках.
 *
 * @since 1.0.0
 */
class CallsResponse extends Source
{
	/**
	 * Информация о неуспешных прозвонах (недозвонах).
	 *
	 * @var FailedCallResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $failed_calls = null; // phpcs:ignore

	/**
	 * Информация о переносах прозвонов
	 *
	 * @var RescheduledCallResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $rescheduled_calls = null; // phpcs:ignore

	/**
	 * Получить параметр - информация о неуспешных прозвонах (недозвонах).
	 *
	 * @return FailedCallResponse[]|null
	 *
	 * @since 1.0.0
	 */
	public function getFailedCalls(): ?array
	{
		return $this->failed_calls; // phpcs:ignore
	}

	/**
	 * Получить параметр - наименование города(места), где произошло изменение статуса.
	 *
	 * @return RescheduledCallResponse[]|null
	 *
	 * @since 1.0.0
	 */
	public function getRescheduledCalls(): ?array
	{
		return $this->rescheduled_calls; // phpcs:ignore
	}
}
