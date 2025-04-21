<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class DeliveryProblemResponse extends AbstractResponse
{
	/**
	 * 1.27.1. Код проблемы (подробнее см. приложение 4)
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
	 * 1.27.1. Код проблемы (подробнее см. приложение 4)
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
	 * 1.27.2. Дата создания проблемы
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
