<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Код региона СДЭК
 *
 * @since 1.0.0
 */
trait RegionCodeTrait
{
	/**
	 * Код региона СДЭК
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $region_code; // phpcs:ignore

	/**
	 * Код региона СДЭК
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getRegionCode(): int
	{
		return $this->region_code; // phpcs:ignore
	}
}
