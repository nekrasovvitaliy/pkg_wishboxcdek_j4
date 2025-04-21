<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\SIte\Exception;

use Exception;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Request\ErrorResponse;

/**
 * @since 1.0.0
 */
class OrdersPatchRequestErrorsException extends Exception
{
	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $orderId;

	/**
	 * @var ErrorResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $errors;

	/**
	 * @param   ErrorResponse[]  $errors   Errors
	 *
	 * @since 1.0.0
	 */
	public function __construct(array $errors)
	{
		$this->errors = $errors;

		$message = static::getErrorMessage($this->errors);

		parent::__construct($message, 200);
	}

	/**
	 * Returns the error message.
	 *
	 * @param   ErrorResponse[]  $errors  Errors
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected static function getErrorMessage(array $errors): string
	{
		$message = 'Last request errors:' . "\n";

		if (count($errors))
		{
			foreach ($errors as $error)
			{
				$message .= $error->getMessage() . "\n";
			}
		}

		return $message;
	}
}
