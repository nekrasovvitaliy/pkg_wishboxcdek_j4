<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use WishboxCdekSDK2\Handler\AbstractHandler;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * @since 1.0.0
 */
abstract class AbstractResponseHandler extends AbstractHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	final public function handle(string $path, ResponseData $responseData): bool
	{
		return $this->handleResponse($path, $responseData);
	}

	/**
	 * Return to parent.
	 *
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	protected function next(string $path, ResponseData $responseData): bool
	{
		return parent::handle($path, $responseData);
	}

	/**
	 * Handle response.
	 *
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	abstract protected function handleResponse(string $path, ResponseData $responseData): bool;
}
