<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Interface;

/**
 * @since 1.0.0
 */
interface ErrorResponseInterface
{
	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string;

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getMessage(): string;
}
