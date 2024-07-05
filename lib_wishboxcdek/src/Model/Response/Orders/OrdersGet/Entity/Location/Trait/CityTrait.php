<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Название города
 *
 * @since 1.0.0
 */
trait CityTrait
{
	/**
	 * Название города
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $city;

	/**
	 * Название города
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCity(): string
	{
		return $this->city;
	}
}
