<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Calls\FailedCallResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Calls\RescheduledCallResponse;

/**
 * @since 1.0.0
 */
class CallsResponse extends AbstractResponse
{
	/**
	 * 1.31.1. Информация о неуспешных прозвонах (недозвонах)
	 *
	 * @var FailedCallResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $failed_calls; // phpcs:ignore

	/**
	 * 1.31.2. Информация о переносах прозвонов
	 *
	 * @var RescheduledCallResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $rescheduled_calls; // phpcs:ignore

	/**
	 * 1.31.1. Информация о неуспешных прозвонах (недозвонах)
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getFailedCalls(): array
	{
		return $this->rescheduled_calls; // phpcs:ignore
	}

	/**
	 * 1.31.2. Информация о переносах прозвонов
	 *
	 * @return RescheduledCallResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getRescheduledCalls(): array
	{
		return $this->rescheduled_calls; // phpcs:ignore
	}
}
