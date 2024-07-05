<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\PackageResponse;

/**
 * Список информации по местам (упаковкам)
 *
 * @since 1.0.0
 */
trait PackagesOptionalTrait
{
	/**
	 * Список информации по местам (упаковкам)
	 *
	 * @var PackageResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $packages; // phpcs:ignore

	/**
	 * Список информации по местам (упаковкам)
	 *
	 * @return PackageResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getPackages(): array
	{
		return $this->packages; // phpcs:ignore
	}

	/**
	 * Список информации по местам (упаковкам)
	 *
	 * @param   PackageResponse[]  $packages  Список информации по местам (упаковкам)
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setPackages(array $packages): static
	{
		$this->packages = $packages; // phpcs:ignore

		return $this;
	}
}
