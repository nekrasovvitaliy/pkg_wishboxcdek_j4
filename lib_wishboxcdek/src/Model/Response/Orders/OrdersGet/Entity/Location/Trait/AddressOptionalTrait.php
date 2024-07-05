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
trait AddressOptionalTrait
{
	/**
	 * Название города
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * Название города
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getAddress(): ?string
	{
		return $this->address;
	}
}
