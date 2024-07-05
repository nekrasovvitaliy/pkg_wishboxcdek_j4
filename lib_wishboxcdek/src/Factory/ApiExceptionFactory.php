<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use Throwable;
use WishboxCdekSDK2\Exception\Api\EntityNotFoundImNumberException;
use WishboxCdekSDK2\Exception\ApiErrorException;
use WishboxCdekSDK2\Interface\ApiExceptionInterface;
use WishboxCdekSDK2\Interface\ResponseInterface;

/**
 * @since 1.0.0
 */
class ApiExceptionFactory
{
	/**
	 * @var string[]
	 *
	 * @since 1.0.0
	 */
	private static array $errorCodesMapping = [
		'v2_entity_not_found_im_number' => EntityNotFoundImNumberException::class,
	];

	/**
	 * Create exception from API response.
	 *
	 * @param   ResponseInterface  $response    Response
	 * @param   integer            $statusCode  Status code
	 * @param   Throwable|null     $previous    Previous
	 *
	 * @return ApiExceptionInterface
	 *
	 * @since 1.0.0
	 */
	public function createException(
		ResponseInterface $response,
		int $statusCode = 0,
		Throwable $previous = null
	): ApiExceptionInterface
	{
		$response->errorMsg = $response->errorMsg ?? '';
		$response->errors = $response->errors ?? [];
		$errorFqn = self::getErrorClassByCode($response->errorMsg ?? '');

		if (class_exists($errorFqn) && is_subclass_of($errorFqn, ApiException::class))
		{
			return new $errorFqn($response, $statusCode, $previous);
		}

		return new ApiErrorException($response, $statusCode, $previous);
	}

	/**
	 * Returns error class by error code.
	 *
	 * @param   string  $code  Code
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getErrorClassByCode(string $code): string
	{
		if (array_key_exists($code, self::$errorCodesMapping))
		{
			return self::$errorCodesMapping[$code];
		}

		return ApiErrorException::class;
	}
}
