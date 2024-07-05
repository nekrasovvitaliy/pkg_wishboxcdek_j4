<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Номер заказа СДЭК
 *
 * @since 1.0.0
 */
trait CdekNumberOptionalTrait
{
	/**
	 * Номер заказа СДЭК
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $cdek_number = null; // phpcs:ignore

	/**
	 * Номер заказа СДЭК
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getCdekNumber(): ?string
	{
		return $this->cdek_number; // phpcs:ignore
	}
}
