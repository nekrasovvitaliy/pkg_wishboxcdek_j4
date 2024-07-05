<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Interface;

use Joomla\Http\Response as HttpResponse;

/**
 * @since 1.0.0
 */
interface HandlerInterface
{
	/**
	 * @param   HandlerInterface  $handler  Handler
	 *
	 * @return HandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function setNext(HandlerInterface $handler): HandlerInterface;

	/**
	 * @param   string        $path      Path
	 * @param   HttpResponse  $response  Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function handle(string $path, HttpResponse $response): bool;
}
