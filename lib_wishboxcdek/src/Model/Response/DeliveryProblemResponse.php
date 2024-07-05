<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

/**
 * @since 1.0.0
 */
class DeliveryProblemResponse extends Source
{
	/**
	 * Код проблемы (подробнее см. приложение 4)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $code; // phpcs:ignore

	/**
	 * Дата создания проблемы
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $create_date; // phpcs:ignore

	/**
	 * Код проблемы (подробнее см. приложение 4)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCode(): ?string
	{
		return $this->code;
	}

	/**
	 * Дата создания проблемы
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCreateDate(): ?string
	{
		return $this->create_date; // phpcs:ignore
	}
}
