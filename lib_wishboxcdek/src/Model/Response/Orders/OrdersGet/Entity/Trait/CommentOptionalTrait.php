<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Комментарий к заказу
 *
 * @since 1.0.0
 */
trait CommentOptionalTrait
{
	/**
	 * Комментарий к заказу
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $comment = null;

	/**
	 * Комментарий к заказу
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getComment(): ?string
	{
		return $this->comment;
	}

	/**
	 * Комментарий к заказу
	 *
	 * @param   string|null  $comment  Комментарий к заказу
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setComment(?string $comment): static
	{
		$this->comment = $comment;

		return $this;
	}
}
