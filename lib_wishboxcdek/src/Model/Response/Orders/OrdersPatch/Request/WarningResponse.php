<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersPatch\Request;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * Предупреждения, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class WarningResponse extends AbstractRequest
{
	/**
	 * 2.6.1. Код предупреждения
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * 2.6.2. Описание предупреждения
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $message;

	/**
	 * 2.6.1. Код предупреждения
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
	 * 2.6.2. Описание предупреждения
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
