<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Идентификатор заказа в ИС СДЭК
 *
 * @since 1.0.0
 */
trait UuidTrait
{
	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid; // phpcs:ignore

	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getUuid(): string
	{
		return $this->uuid; // phpcs:ignore
	}

	/**
	 * Идентификатор заказа в ИС СДЭК
	 *
	 * @param   string  $uuid  Идентификатор заказа в ИС СДЭК
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setUuid(string $uuid): static
	{
		$this->uuid = $uuid; // phpcs:ignore

		return $this;
	}
}
