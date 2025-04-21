<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 *
 * @since 1.0.0
 */
class SellerResponse extends AbstractResponse
{
	/**
	 * Наименование истинного продавца.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $name = null;

	/**
	 * ИНН истинного продавца.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $inn = null;

	/**
	 * Телефон истинного продавца.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $phone = null;

	/**
	 * Код формы собственности.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $ownership_form = null; // phpcs:ignore

	/**
	 * Адрес истинного продавца.
	 * Используется при печати инвойсов для отображения адреса настоящего продавца товара, либо торгового названия.
	 * Только для международных заказов.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $address = null;

	/**
	 * Получить наименование истинного продавца.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Получить ИНН истинного продавца.
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getInn(): ?int
	{
		return $this->inn;
	}

	/**
	 * Получить телефон истинного продавца.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	 * Получить код формы собственности.
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOwnershipForm(): ?int
	{
		return $this->ownership_form; // phpcs:ignore
	}

	/**
	 * Получить адрес истинного продавца.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAddress(): ?string
	{
		return $this->address;
	}
}
