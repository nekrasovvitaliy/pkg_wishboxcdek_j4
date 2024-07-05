<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler;

use Joomla\Http\Response as HttpResponse;
use WishboxCdekSDK2\Interface\HandlerInterface;

/**
 * Represents an abstract handler in the chain of responsibility.
 *
 * @since 1.0.0
 */
abstract class AbstractHandler implements HandlerInterface
{
	/**
	 * @var HandlerInterface
	 *
	 * @since 1.0.0
	 */
	private HandlerInterface $next;

	/**
	 * @param   string        $path      Path
	 * @param   HttpResponse  $response  Response
	 *
	 * @return bool|mixed|null
	 *
	 * @since 1.0.0
	 */
	public function handle(string $path, HttpResponse $response)
	{
		return $this->next->handle($path, $response);
	}

	/**
	 * @param   HandlerInterface  $handler  Handler
	 *
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function setNext(HandlerInterface $handler): HandlerInterface
	{
		$this->next = $handler;

		return $handler;
	}

	/**
	 * @return HandlerInterface|null
	 *
	 * @since 1.0.0
	 */
	public function getNext(): ?HandlerInterface
	{
		return $this->next;
	}

	/**
	 * @param   HandlerInterface  $handler  Handler
	 *
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function append(HandlerInterface $handler): HandlerInterface
	{
		$this->getLastHandler()->setNext($handler);

		return $handler;
	}

	/**
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function getLastHandler(): HandlerInterface
	{
		$lastHandler = $this;

		while (null !== $lastHandler->getNext())
		{
			$lastHandler = $lastHandler->getNext();
		}

		return $lastHandler;
	}
}
