<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Exceptions;

use WishboxCdekSDK2\Constants;
use Exception;

/**
 * @since 1.0.0
 */
class CdekV2Exception extends Exception
{
	/**
	 * @param   integer  $code     Code
	 * @param   string   $message  Message
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function getTranslation(int $code, string $message): string
	{
		if (array_key_exists($code, Constants::ERRORS))
		{
			return Constants::ERRORS[$code] . '. ' . $message;
		}

		return $message;
	}
}
