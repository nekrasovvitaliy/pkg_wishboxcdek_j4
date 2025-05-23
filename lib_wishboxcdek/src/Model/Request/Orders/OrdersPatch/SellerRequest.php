<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPatch;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class SellerRequest extends AbstractRequest
{
	/**
	 * 10.1. Наименование истинного продавца.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $name = null;

	/**
	 * 10.2. ИНН истинного продавца.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $inn = null;

	/**
	 * 10.3. Телефон истинного продавца.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $phone = null;

	/**
	 * 10.4. Код формы собственности.
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $ownership_form = null; // phpcs:ignore

	/**
	 * Адрес истинного продавца.
	 *
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
	 * @param   string|null  $name  Name
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setName(?string $name): self
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Получить ИНН истинного продавца.
	 *
	 * @param   integer|null  $inn  Inn
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setInn(?int $inn): self
	{
		$this->inn = $inn;

		return $this;
	}

	/**
	 * Получить телефон истинного продавца.
	 *
	 * @param   string|null  $phone  Phone
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPhone(?string $phone): self
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * Получить код формы собственности.
	 *
	 * @param   integer|null  $ownershipForm  Ownership Form
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setOwnershipForm(?int $ownershipForm): self
	{
		$this->ownership_form = $ownershipForm; // phpcs:ignore

		return $this;
	}

	/**
	 * Получить адрес истинного продавца.
	 *
	 * @param   string|null  $address  Address
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAddress(?string $address): self
	{
		$this->address = $address;

		return $this;
	}
}
