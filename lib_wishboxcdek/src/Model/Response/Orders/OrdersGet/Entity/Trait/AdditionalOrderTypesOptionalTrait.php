<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Дополнительный тип заказа:
 * 4 - для Forward
 * 6 - для "Фулфилмент. Приход"
 * 7 - для "Фулфилмент. Отгрузка"
 *
 * @since 1.0.0
 */
trait AdditionalOrderTypesOptionalTrait
{
	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $additional_order_types = null; // phpcs:ignore

	/**
	 * Дополнительный тип заказа:
	 * 4 - для Forward
	 * 6 - для "Фулфилмент. Приход"
	 * 7 - для "Фулфилмент. Отгрузка"
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 */
	public function getAdditionalOrderTypes(): ?int
	{
		return $this->additional_order_types; // phpcs:ignore
	}
}
