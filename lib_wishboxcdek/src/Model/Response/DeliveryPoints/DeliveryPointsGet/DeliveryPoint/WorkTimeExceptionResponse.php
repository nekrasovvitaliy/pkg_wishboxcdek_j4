<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class WorkTimeExceptionResponse extends AbstractResponse
{
	/**
	 * 27.1. Дата начала исключения в работе офиса (в формате ISO 8601: YYYY:MM:DD)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_start; // phpcs:ignore

	/**
	 * 27.2 Дата окончания исключения в работе офиса (в формате ISO 8601: YYYY:MM:DD)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_end; // phpcs:ignore

	/**
	 * 27.3 Время начала работы в указанную дату (в формате ISO 8601: HH:mm)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $time_start = null; // phpcs:ignore

	/**
	 * 27.4 Время окончания работы в указанную дату (в формате ISO 8601: HH:mm)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $time_end = null; // phpcs:ignore

	/**
	 * 27.5 Признак рабочего/нерабочего дня в указанную дату
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_working; // phpcs:ignore

	/**
	 * 27.1 Дата начала исключения в работе офиса (в формате ISO 8601: YYYY:MM:DD)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDateStart(): string
	{
		return $this->date_start; // phpcs:ignore
	}

	/**
	 * 27.2 Дата окончания исключения в работе офиса (в формате ISO 8601: YYYY:MM:DD)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDateEnd(): string
	{
		return $this->date_end; // phpcs:ignore
	}

	/**
	 * 27.3 Время начала работы в указанную дату (в формате ISO 8601: HH:mm)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTimeStart(): ?string
	{
		return $this->time_start; // phpcs:ignore
	}

	/**
	 * 27.4 Время окончания работы в указанную дату (в формате ISO 8601: HH:mm)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTimeEnd(): ?string
	{
		return $this->time_end; // phpcs:ignore
	}

	/**
	 * 27.5 Признак рабочего/нерабочего дня в указанную дату
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getIsWorking(): bool
	{
		return $this->is_working; // phpcs:ignore
	}
}
