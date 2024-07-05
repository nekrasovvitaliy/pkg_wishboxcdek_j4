<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Interface;

use Joomla\Http\Response;

/**
 * @since 1.0.0
 */
interface ApiHandlerInterface
{
	/**
	 * @param   ApiHandlerInterface  $apiHandler  API handler
	 *
	 * @return ApiHandlerInterface
	 *
	 * @since 1.0.0
	 */
	public function setNext(ApiHandlerInterface $apiHandler): ApiHandlerInterface;

	/**
	 * @param   string             $path              Path
	 * @param   integer            $httpResponseCode  HTTP response code
	 * @param   ResponseInterface  $response          Response
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function handle(string $path, int $httpResponseCode, Response $response): bool;
}
