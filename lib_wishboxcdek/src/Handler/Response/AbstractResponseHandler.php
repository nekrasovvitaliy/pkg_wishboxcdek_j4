<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response as HttpResponse;
use WishboxCdekSDK2\Handler\AbstractHandler;
use WishboxCdekSDK2\Interface\HandlerInterface;

/**
 * @since 1.0.0
 */
abstract class AbstractResponseHandler extends AbstractHandler
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
	 * @param   string        $path      Path
	 * @param   HttpResponse  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	final public function handle(string $path, HttpResponse $response): bool
	{
			return $this->handleResponse($path, $response);
	}

	/**
	 * Return to parent.
	 *
	 * @param   string        $path      Path
	 * @param   HttpResponse  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	protected function next(string $path, HttpResponse $response): bool
	{
		return parent::handle($path, $response);
	}

	/**
	 * Handle response.
	 *
	 * @param   string        $path      Path
	 * @param   HttpResponse  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	abstract protected function handleResponse(string $path, HttpResponse $response): bool;
}
