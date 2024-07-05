<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Название региона
 *
 * @since 1.0.0
 */
trait RegionOptionalTrait
{
	/**
	 * Название региона
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $region = null;

	/**
	 * Название региона
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getRegion(): ?string
	{
		return $this->region;
	}
}
