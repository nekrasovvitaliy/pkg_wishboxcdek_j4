<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPost\Contact;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class PhoneRequest extends AbstractRequest
{
	/**
	 * Номер телефона.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $number;

	/**
	 * Добавочный номер
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $additional;

	/**
	 * 14.10.1 Номер телефона
	 *         Должен передаваться в международном формате: код страны (для России +7) и сам номер (10 и более цифр)
	 *
	 * @param   string|null  $number  Номер телефона
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setNumber(?string $number): self
	{
		$this->number = $number;

		return $this;
	}

	/**
	 * 14.10.2. Дополнительная информация (добавочный номер)
	 *
	 * @param   string|null  $additional  Дополнительная информация (добавочный номер)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setAdditional(?string $additional): self
	{
		$this->additional = $additional;

		return $this;
	}
}
