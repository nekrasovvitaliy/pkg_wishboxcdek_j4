<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Дополнительный тип заказа:
 * 4 - для Forward
 * 6 - для "Фулфилмент. Приход"
 * 7 - для "Фулфилмент. Отгрузка"
 *
 * @since 1.0.0
 */
trait AdditionalOrderTypesTrait
{
	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $additional_order_types; // phpcs:ignore

	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getAdditionalOrderTypes(): int
	{
		return $this->additional_order_types; // phpcs:ignore
	}
}
