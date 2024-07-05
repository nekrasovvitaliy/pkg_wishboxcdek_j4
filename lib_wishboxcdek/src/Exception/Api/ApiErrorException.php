<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Exception\Api;

use Exception;
use WishboxCdekSDK2\Interface\ApiExceptionInterface;
use Throwable;
use WishboxCdekSDK2\Interface\ResponseInterface;

/**
 * @since 1.0.0
 */
class ApiErrorException extends Exception implements ApiExceptionInterface
{
	/**
	 * @var ResponseInterface
	 *
	 * @since 1.0.0
	 */
	private ResponseInterface $response;

	/**
	 * ApiException constructor.
	 *
	 * @param   ResponseInterface  $response    Error response
	 * @param   integer            $statusCode  Status code
	 * @param   Throwable|null     $previous    Previous
	 *
	 * @since 1.0.0
	 */
	public function __construct(ResponseInterface $response, int $statusCode = 0, Throwable $previous = null)
	{
		$this->response = $response;

		parent::__construct(static::getErrorMessage($this->response), $statusCode, $previous);
	}

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
	 * Returns ErrorResponse.
	 *
	 * @return ResponseInterface
	 *
	 * @since 1.0.0
	 */
	public function getResponse(): ResponseInterface
	{
		return $this->response;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function __toString(): string
	{
		$base = sprintf(
			"API Exception with message '%s' in %s:%d\nResponse status code: %d\n",
			$this->getMessage(),
			$this->getFile(),
			$this->getLine(),
			$this->getStatusCode()
		);
		$errorsList = $this->getResponse()->getErrors();

		if (null !== $errorsList && count($errorsList) > 0)
		{
			$errors = [];

			foreach ($this->getResponse()->getErrors() as $error)
			{
				$errors[] = sprintf(' - %s: %s', $error->getCode(), $error->getMessage());
			}

			$base .= sprintf("Errors:\n%s\n", implode(PHP_EOL, $errors));
		}

		return trim($base . sprintf("Stacktrace: %s", $this->getTraceAsString()));
	}

	/**
	 * Returns the error message.
	 *
	 * @param   ResponseInterface  $response  Response
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getErrorMessage(ResponseInterface $response): string
	{
		$errors = $response->getErrors();

		if (!empty($errors))
		{
			return (string) reset($errors);
		}

		return 'RetailCRM API Error';
	}
}
