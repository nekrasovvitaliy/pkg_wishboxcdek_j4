<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler;

use WishboxCdekSDK2\Interface\HandlerInterface;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * Represents an abstract handler in the chain of responsibility.
 *
 * @since 1.0.0
 */
abstract class AbstractHandler implements HandlerInterface
{
	/**
	 * @var HandlerInterface|null
	 *
	 * @since 1.0.0
	 */
	private ?HandlerInterface $next = null;

	/**
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function handle(string $path, ResponseData $responseData): bool
	{
		if (null !== $this->next)
		{
			return $this->next->handle($path, $responseData);
		}

		return true;
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
