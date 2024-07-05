<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Interface;

use Throwable;

/**
 * Interface ApiExceptionInterface
 *
 * @since 1.0.0
 */
interface ApiExceptionInterface extends Throwable
{
	/**
	 * Returns response status code
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getStatusCode(): int;

	/**
	 * Returns Response.
	 *
	 * @return ResponseInterface
	 *
	 * @since 1.0.0
	 */
	public function getResponse(): ResponseInterface;

	/**
	 * API exception must implement valid __toString() method.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function __toString();
}
