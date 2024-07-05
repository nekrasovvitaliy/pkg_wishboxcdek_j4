<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Exceptions;

use Throwable;

/**
 * @since 1.0.0
 */
class CdekV2RequestException extends CdekV2Exception
{
	/**
	 * @var string|null $errorCode  Error code
	 *
	 * @since 1.0.0
	 */
	public ?string $errorCode;

	/**
	 * @var string|null $errorMessage Error message
	 *
	 * @since 1.0.0
	 */
	public ?string $errorMessage;

	/**
	 * @param   string          $message       Message
	 * @param   integer         $code          Code
	 * @param   Throwable|null  $previous      Previous
	 * @param   string|null     $errorCode     Error code
	 * @param   string|null     $errorMessage  Error message
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		string $message,
		int $code = 0,
		Throwable $previous = null,
		?string $errorCode = null,
		?string $errorMessage = null
	)
	{
		parent::__construct($message, $code, $previous);

		// Save additional information
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
	}
}
