<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekLibrary\Exception\Order;

use Exception;
use WishboxCdek\Response\Error\CdekMessage;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class OrderRequestErrorsException extends Exception
{
	/**
	 * @var CdekMessage[]
	 *
	 * @since 1.0.0
	 */
	protected array $errors;

	/**
	 * @param   CdekMessage[]  $errors  Errors
	 *
	 * @since 1.0.0
	 */
	public function __construct(array $errors)
	{
		$this->errors = $errors;

		parent::__construct(static::getErrorMessage($this->errors), 200);
	}

	/**
	 * @return CdekMessage[]
	 *
	 * @since 1.0.0
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

	/**
	 * @param   CdekMessage[]  $errors  Errors
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected static function getErrorMessage(array $errors): string
	{
		$message = 'Last request errors:' . "\n";

		foreach ($errors as $error)
		{
			$message .= ($error->message ?? $error->code ?? 'Unknown CDEK error') . "\n";
		}

		return $message;
	}
}
