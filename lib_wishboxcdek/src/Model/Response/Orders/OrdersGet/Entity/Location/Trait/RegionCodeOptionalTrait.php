<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Код региона СДЭК
 *
 * @since 1.0.0
 */
trait RegionCodeOptionalTrait
{
	/**
	 * Код региона СДЭК
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $region_code = null; // phpcs:ignore

	/**
	 * Код региона СДЭК
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 */
	public function getRegionCode(): ?int
	{
		return $this->region_code; // phpcs:ignore
	}
}
