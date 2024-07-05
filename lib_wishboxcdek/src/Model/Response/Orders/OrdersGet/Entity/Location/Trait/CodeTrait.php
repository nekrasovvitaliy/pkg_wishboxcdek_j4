<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
 *
 * @since 1.0.0
 */
trait CodeTrait
{
	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $code;

	/**
	 * Код населенного пункта СДЭК (метод "Список населенных пунктов")
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCode(): int
	{
		return $this->code;
	}
}
