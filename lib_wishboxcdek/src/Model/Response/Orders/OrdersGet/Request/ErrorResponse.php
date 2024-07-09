<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Request;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * Ошибки, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class ErrorResponse extends AbstractResponse
{
	/**
	 * 2.5.1. Код ошибки
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 2.5.2. Описание ошибки
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $message;

	/**
	 * 2.5.1. Код ошибки
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * 2.5.2. Описание ошибки
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}
