<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\CallsResponse;

/**
 * Информация о прозвонах получателя
 *
 * @since 1.0.0
 */
trait CallsOptionalTrait
{
	/**
	 * Информация о прозвонах получателя
	 *
	 * @var CallsResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?CallsResponse $cals; // phpcs:ignore

	/**
	 * Информация о прозвонах получателя
	 *
	 * @return CallsResponse
	 *
	 * @since 1.0.0
	 */
	public function getCalls(): CallsResponse
	{
		return $this->cals; // phpcs:ignore
	}

	/**
	 * Информация о прозвонах получателя
	 *
	 * @param   CallsResponse  $cals  Информация о прозвонах получателя
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setCalls(CallsResponse $cals): static
	{
		$this->cals = $cals; // phpcs:ignore

		return $this;
	}
}
