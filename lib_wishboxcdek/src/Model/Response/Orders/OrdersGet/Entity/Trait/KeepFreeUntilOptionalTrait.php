<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Срок бесплатного хранения заказа на складе
 *
 * @since 1.0.0
 */
trait KeepFreeUntilOptionalTrait
{
	/**
	 * Срок бесплатного хранения заказа на складе
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $keep_free_until; // phpcs:ignore

	/**
	 * Срок бесплатного хранения заказа на складе
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getKeepFreeUntil(): ?string
	{
		return $this->keep_free_until; // phpcs:ignore
	}

	/**
	 * Срок бесплатного хранения заказа на складе
	 *
	 * @param   string|null  $keepFreeUntil  Срок бесплатного хранения заказа на складе
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setKeepFreeUntil(?string $keepFreeUntil): static
	{
		$this->keep_free_until = $keepFreeUntil; // phpcs:ignore

		return $this;
	}
}
