<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response\Api;

use Joomla\Http\Response;
use WishboxCdekSDK2\Interface\HandlerInterface;

/**
 * Class AbstractResponseHandler
 *
 * @since 1.0.0
 */
abstract class AbstractHandler
{
	/**
	 * The next handler in the chain.
	 *
	 * @var  HandlerInterface|null
	 *
	 * @since 1.0.0
	 */
	private ?HandlerInterface $nextHandler = null;

	/**
	 * Set the next handler in the chain.
	 *
	 * @param   HandlerInterface  $handler  The next handler
	 *
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function setNext(HandlerInterface $handler): HandlerInterface
	{
		$this->nextHandler = $handler;

		return $handler;
	}

	/**
	 * Handle the request.
	 *
	 * @param   string    $path      The request path
	 * @param   string    $type      Type
	 * @param   Response  $response  The response object
	 *
	 * @return boolean True if the request was handled successfully, false otherwise
	 *
	 * @since 1.0.0
	 */
	public function handle(string $path, string $type, Response $response): bool
	{
		if ($this->nextHandler)
		{
			return $this->nextHandler->handle($path, $type, $response);
		}

		return true;
	}

	/**
	 * @param   string    $path      Path
	 * @param   string    $type      Type
	 * @param   Response  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	final public function handle(string $path, string $type, Response $response): bool
	{
		if ($response instanceof Response)
		{
			return $this->handleResponse($path, $type, $response);
		}

		return parent::handle($path, $type, $response);
	}

	/**
	 * Return to parent.
	 *
	 * @param   string    $path      Path
	 * @param   string    $type      Type
	 * @param   Response  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	protected function next(string $path, string $type, Response $response): bool
	{
		return parent::handle($path, $type, $response);
	}

	/**
	 * Handle response.
	 *
	 * @param   string    $path      Path
	 * @param   string    $type      Type
	 * @param   Response  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	abstract protected function handleResponse(string $path, string $type, Response $response): bool;
}
