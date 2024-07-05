<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\ServiceResponse;

/**
 * Адрес получения
 *
 * @since 1.0.0
 */
trait ServicesOptionalTrait
{
	/**
	 * Адрес получения
	 *
	 * @var ServiceResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $services; // phpcs:ignore

	/**
	 * Адрес получения
	 *
	 * @return ServiceResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getServices(): array
	{
		return $this->services; // phpcs:ignore
	}

	/**
	 * Адрес получения
	 *
	 * @param   ServiceResponse[]  $services  Адрес получения
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setServices(array $services): static
	{
		$this->services = $services; // phpcs:ignore

		return $this;
	}
}
