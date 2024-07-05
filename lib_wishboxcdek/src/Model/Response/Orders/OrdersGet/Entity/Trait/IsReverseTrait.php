<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Признак реверсного заказа:
 * true - реверсный
 * false - не реверсный
 *
 * @since 1.0.0
 */
trait IsReverseTrait
{
	/**
	 * Признак реверсного заказа:
	 * true - реверсный
	 * false - не реверсный
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $is_reverse; // phpcs:ignore

	/**
	 * Признак реверсного заказа:
	 * true - реверсный
	 * false - не реверсный
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getIsReverse(): string
	{
		return $this->is_reverse; // phpcs:ignore
	}

	/**
	 * Признак реверсного заказа:
	 * true - реверсный
	 * false - не реверсный
	 *
	 * @param   string  $isReverse  Комментарий к заказу
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setIsReverse(string $isReverse): static
	{
		$this->is_reverse = $isReverse; // phpcs:ignore

		return $this;
	}
}
