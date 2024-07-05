<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Название региона
 *
 * @since 1.0.0
 */
trait RegionTrait
{
	/**
	 * Название региона
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $region;

	/**
	 * Название региона
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getRegion(): string
	{
		return $this->region;
	}
}
