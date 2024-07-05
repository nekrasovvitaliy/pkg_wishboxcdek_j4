<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Ключ разработчика (для разработчиков модулей)
 *
 * @since 1.0.0
 */
trait DeveloperKeyOptionalTrait
{
	/**
	 * Ключ разработчика (для разработчиков модулей)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $developer_key = null; // phpcs:ignore

	/**
	 * Ключ разработчика (для разработчиков модулей)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getDeveloperKey(): ?string
	{
		return $this->developer_key; // phpcs:ignore
	}

	/**
	 * Ключ разработчика (для разработчиков модулей)
	 *
	 * @param   string|null  $developerKey  Комментарий к заказу
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setDeveloperKey(?string $developerKey): static
	{
		$this->developer_key = $developerKey; // phpcs:ignore

		return $this;
	}
}
