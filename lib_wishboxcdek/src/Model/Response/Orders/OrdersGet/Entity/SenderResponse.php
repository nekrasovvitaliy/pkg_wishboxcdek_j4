<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Entity\Requests\Phone;
use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class SenderResponse extends AbstractResponse
{
	/**
	 * 1.20.1. Название компании.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $company = null;

	/**
	 * ФИО контактного лица.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $name = null;

	/**
	 * Требования по паспортным данным удовлетворены (актуально для международных заказов):
	 *
	 * true - паспортные данные собраны или не требуются
	 * false - паспортные данные требуются и не собраны
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $passport_requirements_satisfied = null; // phpcs:ignore

	/**
	 * Серия паспорта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_series = null; // phpcs:ignore

	/**
	 * Номер паспорта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_number = null; // phpcs:ignore

	/**
	 * Дата выдачи паспорта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_date_of_issue = null; // phpcs:ignore

	/**
	 * Орган выдачи паспорта.
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $passport_organization = null; // phpcs:ignore

	/**
	 * ИНН.
	 * Может содержать 10, либо 12 символов.
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
	protected ?string $passport_date_of_birth = null; // phpcs:ignore

	/**
	 * Список телефонов.
	 *
	 * @var Phone[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $phones = null;

	/**
	 * Тип отправителя.
	 * Возможные значения:
	 * LEGAL_ENTITY - юридическое лицо
	 * INDIVIDUAL - физическое лицо
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $contragent_type = null; // phpcs:ignore

	/**
	 * 1.20.1. Название компании.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCompany(): ?string
	{
		return $this->company;
	}

	/**
	 * ФИО контактного лица.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Требования по паспортным данным удовлетворены (актуально для международных заказов).
	 *
	 * @return boolean|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportRequirementsSatisfied(): ?bool
	{
		return $this->passport_requirements_satisfied; // phpcs:ignore
	}

	/**
	 * Серия паспорта.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportSeries(): ?string
	{
		return $this->passport_series; // phpcs:ignore
	}

	/**
	 * Номер паспорта.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportNumber(): ?string
	{
		return $this->passport_number; // phpcs:ignore
	}

	/**
	 * Дата выдачи паспорта.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportDateOfIssue(): ?string
	{
		return $this->passport_date_of_issue; // phpcs:ignore
	}

	/**
	 * Орган выдачи паспорта.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportOrganization(): ?string
	{
		return $this->passport_organization; // phpcs:ignore
	}

	/**
	 * ИНН.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}

	/**
	 * Дата рождения получателя (только для международных заказов).
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPassportDateOfBirth(): ?string
	{
		return $this->passport_date_of_birth; // phpcs:ignore
	}

	/**
	 * Список телефонов.
	 *
	 * @return Phone[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getPhones(): ?array
	{
		return $this->phones;
	}

	/**
	 * Тип отправителя.
	 *  Возможные значения:
	 *  LEGAL_ENTITY - юридическое лицо
	 *  INDIVIDUAL - физическое лицо
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getContragentType(): ?string
	{
		return $this->contragent_type; // phpcs:ignore
	}
}
