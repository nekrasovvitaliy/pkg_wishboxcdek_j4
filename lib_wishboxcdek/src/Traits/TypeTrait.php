<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Тип заказа:
 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
 * 2 - "доставка" (для любого договора)
 *
 * @since 1.0.0
 */
trait TypeTrait
{
	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getType(): string
	{
		return $this->type;
	}
}
