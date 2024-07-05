<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\ContactResponse;

/**
 * Отправитель
 *
 * @since 1.0.0
 */
trait SenderTrait
{
	/**
	 * Отправитель
	 *
	 * @var ContactResponse
	 *
	 * @since 1.0.0
	 */
	protected ContactResponse $sender; // phpcs:ignore

	/**
	 * Отправитель
	 *
	 * @return ContactResponse
	 *
	 * @since 1.0.0
	 */
	public function getSender(): ContactResponse
	{
		return $this->sender; // phpcs:ignore
	}

	/**
	 * Отправитель
	 *
	 * @param   ContactResponse  $sender  Отправитель
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setSender(ContactResponse $sender): static
	{
		$this->sender = $sender; // phpcs:ignore

		return $this;
	}
}
