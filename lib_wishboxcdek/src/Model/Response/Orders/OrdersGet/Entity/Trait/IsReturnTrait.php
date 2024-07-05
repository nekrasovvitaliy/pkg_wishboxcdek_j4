<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Признак возвратного заказа:
 * true - возвратный
 * false - прямой
 *
 * @since 1.0.0
 */
trait IsReturnTrait
{
	/**
	 * Признак возвратного заказа:
	 * true - возвратный
	 * false - прямой
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	protected bool $is_return; // phpcs:ignore

	/**
	 * Признак возвратного заказа:
	 * true - возвратный
	 * false - прямой
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function getIsReturn(): bool
	{
		return $this->is_return; // phpcs:ignore
	}

	/**
	 * Признак возвратного заказа:
	 * true - возвратный
	 * false - прямой
	 *
	 * @param   boolean  $isReturn  Признак возвратного заказа:
	 *                              true - возвратный
	 *                              false - прямой
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setIsReturn(bool $isReturn): static
	{
		$this->is_return = $isReturn; // phpcs:ignore

		return $this;
	}
}
