<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\DeliveryProblemResponse;

/**
 * Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
 *
 * @since 1.0.0
 */
trait DeliveryProblemOptionalTrait
{
	/**
	 * Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
	 *
	 * @var DeliveryProblemResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $delivery_problem; // phpcs:ignore

	/**
	 * Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
	 *
	 * @return DeliveryProblemResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryProblem(): array
	{
		return $this->delivery_problem; // phpcs:ignore
	}

	/**
	 * Проблемы доставки, с которыми столкнулся курьер при доставке заказа "до двери"
	 *
	 * @param   DeliveryProblemResponse[]  $deliveryProblem  Проблемы доставки, с которыми столкнулся курьер
	 *                                                       при доставке заказа "до двери"
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeliveryProblem(array $deliveryProblem): static
	{
		$this->delivery_problem = $deliveryProblem; // phpcs:ignore

		return $this;
	}
}
