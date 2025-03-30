<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\Request;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class ErrorResponse extends AbstractResponse
{
	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $message;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}
