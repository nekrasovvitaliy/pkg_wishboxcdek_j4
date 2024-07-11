<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPost;

use WishboxCdekSDK2\Model\Request\AbstractRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\Contact\PhoneRequest;

/**
 * @since 1.0.0
 */
class ContactRequest extends AbstractRequest
{
	/**
	 * 14.1. Название компании
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $company = null;

	/**
	 * 14.2. ФИО контактного лица
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $name = null;

	/**
	 * 14.3. Электронный адрес, используется для оповещений. Должен соответствовать RFC 2822.
	 *       Основные требования:
	 *       допустимы только символы латинского алфавита, числа 0-9, символы: ! $ & * - = \ ^ `| ~ #% '+ /? _ { }
	 *
	 *       Домен (часть почты после @) должен существовать.
	 *       Email должен содержать только один символ @
	 *       Если email указан некорректно, то он будет удалён, а заказ создан.
	 *
	 *       Для международных заказов рекомендуется указывать e-mail.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $email = null;

	/**
	 * Серия паспорта получателя(только для международных заказов).
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_series = null;  // phpcs:ignore

	/**
	 * Номер паспорта получателя (только для международных заказов).
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_number = null;  // phpcs:ignore

	/**
	 * Дата выдачи паспорта получателя (только для международных заказов).
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_date_of_issue = null;  // phpcs:ignore

	/**
	 * Орган выдачи паспорта
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_organization = null;  // phpcs:ignore

	/**
	 * 14.8. ИНН получателя (только для международных заказов).
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $tin = null;

	/**
	 * Дата рождения получателя (только для международных заказов).
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_date_of_birth = null;  // phpcs:ignore

	/**
	 * 14.10 Список телефонов
	 *       Не более 10 номеров
	 *
	 * @var PhoneRequest[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $phones = null;

	/**
	 * 14.11. Тип отправителя.
	 *        Возможные значения:
	 *        LEGAL_ENTITY - юридическое лицо
	 *        INDIVIDUAL - физическое лицо
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $contragent_type = null; // phpcs:ignore

	/**
	 * Название компании
	 *
	 * @param   string|null  $company  Название компании
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setCompany(?string $company): self
	{
		$this->company = $company;

		return $this;
	}

	/**
	 * ФИО контактного лица
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
	 * Электронный адрес, используется для оповещений
	 *
	 * @param   string|null  $email  Электронный адрес
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setEmail(?string $email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Серия паспорта
	 *
	 * @param   string|null  $passportSeries  Серия паспорта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPassportSeries(?string $passportSeries): self
	{
		$this->passport_series = $passportSeries; // phpcs:ignore

		return $this;
	}

	/**
	 * Номер паспорта получателя
	 *
	 * @param   string|null  $passportNumber  Номер паспорта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPassportNumber(?string $passportNumber): self
	{
		$this->passport_number = $passportNumber; // phpcs:ignore

		return $this;
	}

	/**
	 * 14.6. Дата выдачи паспорта
	 *
	 * @param   string|null  $passportDateOfIssue  Дата выдачи паспорта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPassportDateOfIssue(?string $passportDateOfIssue): self
	{
		$this->passport_date_of_issue = $passportDateOfIssue; // phpcs:ignore

		return $this;
	}

	/**
	 * 14.7. Орган выдачи паспорта
	 *
	 * @param   string|null  $passportOrganization  Орган выдачи паспорта
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPassportOrganization(?string $passportOrganization): self
	{
		$this->passport_organization = $passportOrganization; // phpcs:ignore

		return $this;
	}

	/**
	 * 14.8. ИНН
	 *       Может содержать 10, либо 12 символов
	 *
	 * @param   string|null  $tin  ИНН
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setTin(?string $tin): self
	{
		$this->tin = $tin;

		return $this;
	}

	/**
	 * 14.9. Дата рождения получателя (только для международных заказов)
	 *
	 * @param   string|null  $passportDateOfBirth  Дата рождения получателя (только для международных заказов)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPassportDateOfBirth(?string $passportDateOfBirth): self
	{
		$this->passport_date_of_birth = $passportDateOfBirth; // phpcs:ignore

		return $this;
	}

	/**
	 * 14.10. Список телефонов
	 *        Не более 10 номеров
	 *
	 * @param   PhoneRequest[]|null  $phones  Список телефонов
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setPhones(?array $phones): self
	{
		$this->phones = $phones;

		return $this;
	}

	/**
	 * 14.11. Тип отправителя.
	 *        Возможные значения:
	 *        LEGAL_ENTITY - юридическое лицо
	 *        INDIVIDUAL - физическое лицо
	 *
	 * @param   string|null  $contragentType  Тип отправителя.
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setContragentType(?string $contragentType): self
	{
		$this->contragent_type = $contragentType; // phpcs:ignore

		return $this;
	}
}
