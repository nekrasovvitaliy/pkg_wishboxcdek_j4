<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

/**
 * Номер заказа в ИС Клиента.
 * При запросе информации по данному полю возможны варианты:
 * - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
 * - если найдено больше 1, то выбирается созданный с самой последней датой.
 *
 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
 *
 * @since 1.0.0
 */
trait NumberOptionalTrait
{
	/**
	 * Номер заказа в ИС Клиента.
	 * При запросе информации по данному полю возможны варианты:
	 * - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
	 * - если найдено больше 1, то выбирается созданный с самой последней датой.
	 *
	 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $number = null;

	/**
	 * Номер заказа в ИС Клиента.
	 * При запросе информации по данному полю возможны варианты:
	 * - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
	 * - если найдено больше 1, то выбирается созданный с самой последней датой.
	 *
	 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getNumber(): ?string
	{
		return $this->number;
	}

	/**
	 * Комментарий к заказу
	 *
	 * @param   string|null  $number  Номер заказа в ИС Клиента.
	 *                                При запросе информации по данному полю возможны варианты:
	 *                                - если не передан, будет присвоен номер заказа в ИС СДЭК - uuid;
	 *                                - если найдено больше 1, то выбирается созданный с самой последней датой.
	 *
	 * Может содержать только цифры, буквы латинского алфавита или спецсимволы (формат ASCII)
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setNumber(?string $number): static
	{
		$this->number = $number;

		return $this;
	}
}
