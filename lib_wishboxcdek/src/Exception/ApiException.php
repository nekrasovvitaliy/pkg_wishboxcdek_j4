<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Exception;

use Exception;
use Throwable;
use WishboxCdekSDK2\Interface\ApiExceptionInterface;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * @since 1.0.0
 */
class ApiException extends Exception implements ApiExceptionInterface
{
	/**
	 * @var ResponseData
	 *
	 * @since 1.0.0
	 */
	protected ResponseData $responseData;

	/**
	 * Returns response status code
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getStatusCode(): int
	{
		return $this->code;
	}

	/**
	 * @return ResponseData
	 *
	 * @since 1.0.0
	 */
	public function getResponseData(): ResponseData
	{
		return $this->responseData;
	}

	/**
	 * ApiException constructor.
	 *
	 * @param   ResponseData    $responseData    Response data
	 * @param   Throwable|null  $previous        Previous
	 *
	 * @since 1.0.0
	 */
	public function __construct(ResponseData $responseData, Throwable $previous = null)
	{
		$this->responseData = $responseData;
		$message = static::getErrorMessage($this->responseData);
		$code = $responseData->getCode();

		parent::__construct($message, $code, $previous);
	}

	/**
	 * Returns the error message.
	 *
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function getErrorMessage(ResponseData $responseData): string
	{
		$errors = self::getResponseErrors($responseData);

		$errorMessages = [];

		foreach ($errors as $error)
		{
			$errorMessages[] = $error->message;
		}

		return implode("\n", $errorMessages);
	}

	/**
	 * @param   ResponseData  $responseData  Response
	 *
	 * @return array|null
	 *
	 * @since 1.0.0
	 */
	public static function getResponseErrors(ResponseData $responseData): ?array
	{
		$responseBody = $responseData->getBody();
		$responseBodyData = json_decode($responseBody);

		if (isset($responseBodyData->errors))
		{
			return $responseBodyData->errors;
		}

		if (isset($responseBodyData->requests)
			&& is_array($responseBodyData->requests)
			&& count($responseBodyData->requests)
			&& is_array($responseBodyData->requests[0]->errors))
		{
			return $responseBodyData->requests[0]->errors;
		}

		return null;
	}
}
