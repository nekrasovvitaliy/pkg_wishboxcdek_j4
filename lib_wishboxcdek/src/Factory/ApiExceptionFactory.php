<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use Throwable;
use WishboxCdekSDK2\Exception\Api\ErrorException;
use WishboxCdekSDK2\Exception\Api\ErrorsException;
use WishboxCdekSDK2\Exception\Api\RequestError\EntityNotFoundImNumberException;
use WishboxCdekSDK2\Exception\Api\RequestErrorException;
use WishboxCdekSDK2\Interface\ApiExceptionInterface;
use WishboxCdekSDK2\Model\ResponseData;

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
	];

	/**
	 * @var string[]
	 *
	 * @since 1.0.0
	 */
	private static array $errorsCodesMapping = [
	];

	/**
	 * @var string[]
	 *
	 * @since 1.0.0
	 */
	private static array $requestErrorCodesMapping = [
		'v2_entity_not_found_im_number' => EntityNotFoundImNumberException::class,
	];

	/**
	 * Create exception from API response
	 *
	 * @param   string          $errorCode     Error code
	 * @param   ResponseData    $responseData  Response data
	 * @param   Throwable|null  $previous      Previous
	 *
	 * @return ApiExceptionInterface
	 *
	 * @since 1.0.0
	 */
	public static function createErrorException(
		string $errorCode,
		ResponseData $responseData,
		Throwable $previous = null
	): ApiExceptionInterface
	{
		$errorFqn = self::getErrorExceptionClassByCode($errorCode);

		if (class_exists($errorFqn) && is_subclass_of($errorFqn, ErrorException::class))
		{
			return new $errorFqn($responseData, $previous);
		}

		return new ErrorException($responseData, $previous);
	}

	/**
	 * Create exception from API response
	 *
	 * @param   string          $errorCode     Error code
	 * @param   ResponseData    $responseData  Response data
	 * @param   Throwable|null  $previous      Previous
	 *
	 * @return ApiExceptionInterface
	 *
	 * @since 1.0.0
	 */
	public static function createErrorsException(
		string $errorCode,
		ResponseData $responseData,
		Throwable $previous = null
	): ApiExceptionInterface
	{
		$errorFqn = self::getErrorsExceptionClassByCode($errorCode);

		if (class_exists($errorFqn) && is_subclass_of($errorFqn, ErrorsException::class))
		{
			return new $errorFqn($responseData, $previous);
		}

		return new ErrorsException($responseData, $previous);
	}

	/**
	 * Create exception from API response
	 *
	 * @param   string          $errorCode     Error code
	 * @param   ResponseData    $responseData  Response data
	 * @param   Throwable|null  $previous      Previous
	 *
	 * @return ApiExceptionInterface
	 *
	 * @since 1.0.0
	 */
	public static function createRequestErrorException(
		string $errorCode,
		ResponseData $responseData,
		Throwable $previous = null
	): ApiExceptionInterface
	{
		$errorFqn = self::getRequestErrorExceptionClassByCode($errorCode);

		if (class_exists($errorFqn) && is_subclass_of($errorFqn, RequestErrorException::class))
		{
			return new $errorFqn($responseData, $previous);
		}

		return new RequestErrorException($responseData, $previous);
	}

	/**
	 * @param   string  $code  Code
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getErrorExceptionClassByCode(string $code): string
	{
		if (array_key_exists($code, self::$errorCodesMapping))
		{
			return self::$errorCodesMapping[$code];
		}

		return ErrorException::class;
	}

	/**
	 * @param   string  $code  Code
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getErrorsExceptionClassByCode(string $code): string
	{
		if (array_key_exists($code, self::$errorsCodesMapping))
		{
			return self::$errorsCodesMapping[$code];
		}

		return ErrorsException::class;
	}

	/**
	 * @param   string  $code  Code
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getRequestErrorExceptionClassByCode(string $code): string
	{
		if (array_key_exists($code, self::$requestErrorCodesMapping))
		{
			return self::$requestErrorCodesMapping[$code];
		}

		return RequestErrorException::class;
	}
}
