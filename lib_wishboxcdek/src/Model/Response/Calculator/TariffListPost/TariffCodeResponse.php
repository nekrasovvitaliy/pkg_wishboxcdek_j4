<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Calculator\TariffListPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class TariffCodeResponse extends AbstractResponse
{
	/**
	 * 1.1 Код тарифа.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $tariff_code; // phpcs:ignore

	/**
	 * 1.2 Название тарифа на языке вывода.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $tariff_name; // phpcs:ignore

	/**
	 * 1.3 Описание тарифа на языке вывода.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $tariff_description = null; // phpcs:ignore

	/**
	 * 1.4. Режим тарифа (подробнее см. приложение 3)
	 *
	 * @var integer
	 *
	 * @see https://api-docs.cdek.ru/63345519.html
	 *
	 * @since 1.0.0
	 */
	protected int $delivery_mode; // phpcs:ignore

	/**
	 * 1.5 Стоимость доставки
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $delivery_sum; // phpcs:ignore

	/**
	 * 1.6 Минимальное время доставки (в рабочих днях)
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $period_min; // phpcs:ignore

	/**
	 * 1.7 Максимальное время доставки (в рабочих днях)
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $period_max; // phpcs:ignore

	/**
	 * 1.8 Минимальное время доставки (в календарных днях)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $calendar_min = null; // phpcs:ignore

	/**
	 * 1.9 Максимальное время доставки (в календарных днях)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $calendar_max = null; // phpcs:ignore


	/**
	 * 1.1 Получить код тарифа.
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTariffCode(): int
	{
		return $this->tariff_code; // phpcs:ignore
	}

	/**
	 * 1.2 Получить название тарифа на языке вывода.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTariffName(): string
	{
		return $this->tariff_name; // phpcs:ignore
	}

	/**
	 * 1.3 Получить описание тарифа на языке вывода.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTariffDescription(): ?string
	{
		return $this->tariff_description; // phpcs:ignore
	}

	/**
	 * 1.4 Получить режим тарифа.
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDeliveryMode(): int
	{
		return $this->delivery_mode; // phpcs:ignore
	}

	/**
	 * 1.5 Получить стоимость доставки.
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDeliverySum(): float
	{
		return $this->delivery_sum; // phpcs:ignore
	}

	/**
	 * 1.6 Получить минимальное время доставки (в рабочих днях).
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPeriodMin(): int
	{
		return $this->period_min; // phpcs:ignore
	}

	/**
	 * 1.7 Получить максимальное время доставки (в рабочих днях).
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPeriodMax(): int
	{
		return $this->period_max; // phpcs:ignore
	}

	/**
	 * 1.8 Получить минимальное время доставки (в календарных днях).
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCalendarMin(): ?int
	{
		return $this->calendar_min; // phpcs:ignore
	}

	/**
	 * 1.9 Получить максимальное время доставки (в календарных днях).
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCalendarMax(): ?int
	{
		return $this->calendar_max; // phpcs:ignore
	}
}
