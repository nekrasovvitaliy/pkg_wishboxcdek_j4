<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use WishboxCdekSDK2\Handler\Response\AccountNotFoundHandler;
use WishboxCdekSDK2\Handler\Response\ErrorResponseHandler;
use WishboxCdekSDK2\Handler\Response\InvalidClientHandler;
use WishboxCdekSDK2\Handler\Response\OrderNotFoundHandler;
use WishboxCdekSDK2\Handler\Response\ServiceUnavailableHandler;
use WishboxCdekSDK2\Handler\Response\UnauthorizedHandler;
use WishboxCdekSDK2\Interface\ApiHandlerInterface;
use WishboxCdekSDK2\Interface\HandlerInterface;

/**
 * Class ResponsePipelineFactory
 *
 * @since 1.0.0
 */
class ResponsePipelineFactory
{
	/**
	 * Creates default response pipeline.
	 *
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public static function createDefaultPipeline(): HandlerInterface
	{
		$serviceUnavailableHandler = new ServiceUnavailableHandler;
		$unauthorizedHandler = new UnauthorizedHandler;
		$invalidClientHandler = new InvalidClientHandler;
		$orderNotFoundHandler = new OrderNotFoundHandler;
		$handler = new AccountNotFoundHandler;
		$handler->setNext($unauthorizedHandler)
			->setNext($invalidClientHandler)
			->setNext($serviceUnavailableHandler)
			->setNext($orderNotFoundHandler);

		return $handler;
	}

	/**
	 * Creates default response pipeline.
	 *
	 * @return ApiHandlerInterface
	 *
	 * @since 1.0.0
	 */
	public static function createApiPipeline(): ApiHandlerInterface
	{
		$handler = new ErrorResponseHandler;

		return $handler;
	}
}
