<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Calculator\TariffListPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * 2.5. Ошибки, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class ErrorResponse extends AbstractResponse
{
	/**
	 * 2.1. Код ошибки
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 2.2. Описание ошибки
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
