<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * Ошибки, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class ErrorResponse extends AbstractResponse
{
	/**
	 * Код ошибки
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * Описание ошибки
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $message;

	/**
	 * Код ошибки
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
	 * Описание ошибки
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
