<?php
/**
 * @copyright   (c) 2013-2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Interface;

use Joomla\Database\DatabaseDriver;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPost\PackageRequest;

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
interface CalculatorDelegateInterface
{
	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getShippingMethodId() : int;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getSenderCityCode(): int;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getReceiverCityCode(): int;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getTotalWeight(): int;

	/**
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getTariffCodes(): array;

	/**
	 * @return PackageRequest[]
	 *
	 * @since 1.0.0
	 */
	public function getPackages(): array;

	/**
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function useDimensions(): bool;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getPackageWidth(): int;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getPackageHeight(): int;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getPackageLength(): int;
}
