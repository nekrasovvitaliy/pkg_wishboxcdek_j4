<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace WishboxCdekLibrary\Interface;

use Joomla\Database\DatabaseDriver;
use stdClass;
use WishboxCdek\Request\Calculator\CalcPackageRequestDto;

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
interface CalculatorAdapterInterface
{
	public \stdClass $method {
		get;
	}

	public array $formData {
		get;
	}

	public array $products {
		get;
	}

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
	 * @return CalcPackageRequestDto[]
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
}
