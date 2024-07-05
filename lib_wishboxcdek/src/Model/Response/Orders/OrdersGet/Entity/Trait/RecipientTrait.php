<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\ContactResponse;

/**
 * Получатель
 *
 * @since 1.0.0
 */
trait RecipientTrait
{
	/**
	 * Получатель
	 *
	 * @var ContactResponse
	 *
	 * @since 1.0.0
	 */
	protected ContactResponse $recipient; // phpcs:ignore

	/**
	 * Получатель
	 *
	 * @return ContactResponse
	 *
	 * @since 1.0.0
	 */
	public function getRecipient(): ContactResponse
	{
		return $this->recipient; // phpcs:ignore
	}

	/**
	 * Получатель
	 *
	 * @param   ContactResponse  $recipient  Отправитель
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setRecipient(ContactResponse $recipient): static
	{
		$this->recipient = $recipient; // phpcs:ignore

		return $this;
	}
}
