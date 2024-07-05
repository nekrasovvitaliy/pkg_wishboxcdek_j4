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
trait TypeOptionalTrait
{
	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $type = null;

	/**
	 * Тип заказа:
	 * 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
	 * 2 - "доставка" (для любого договора)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getType(): ?string
	{
		return $this->type;
	}
}
