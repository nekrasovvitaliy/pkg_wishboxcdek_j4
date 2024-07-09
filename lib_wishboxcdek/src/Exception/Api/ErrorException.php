<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Exception\Api;

use WishboxCdekSDK2\Exception\ApiException;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * @since 1.0.0
 */
class ErrorException extends ApiException
{
	/**
	 * Returns the error message.
	 *
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	public static function getErrorMessage(ResponseData $responseData): string
	{
		$responseDataBody = $responseData->getBody();
		$responseDataBodyObject = json_decode($responseDataBody);

		$message = $responseDataBodyObject->error_description ?? $responseDataBodyObject->error; // phpcs:ignore

		return $message;
	}
}
