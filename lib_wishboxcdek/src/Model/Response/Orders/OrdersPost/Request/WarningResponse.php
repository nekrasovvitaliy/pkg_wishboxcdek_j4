<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersPost\Request;

use WishboxCdekSDK2\Entity\Requests\Source;

/**
 * Предупреждения, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class WarningResponse extends Source
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
