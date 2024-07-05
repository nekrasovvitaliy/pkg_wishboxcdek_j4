<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Interface;

use Throwable;

/**
 * Interface ClientExceptionInterface
 *
 * @since 1.0.0
 */
interface ClientExceptionInterface extends Throwable
{
	/**
	 * Client exception must implement valid __toString() method.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function __toString();
}
