<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * Class Phone
 * Номер телефона (мобильный/городской).
 *
 * @since 1.0.0
 */
class PhoneResponse extends AbstractResponse
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
	 * Получить параметр - номер телефона.
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
	 * Получить параметр - добавочный номер
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getAdditional(): ?string
	{
		return $this->additional;
	}
}
