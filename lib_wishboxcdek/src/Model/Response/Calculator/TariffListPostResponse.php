<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Calculator;

use WishboxCdekSDK2\Model\Entity\ErrorResponse;
use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Calculator\TariffListPost\TariffCodeResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class TariffListPostResponse extends AbstractResponse
{
	/**
	 * 1. Доступные тарифы
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Calculator\TariffListPost\TariffCodeResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $tariff_codes = null; // phpcs:ignore

	/**
	 * 2. Список ошибок
	 *
	 * @var \WishboxCdekSDK2\Model\Entity\ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $errors = null;

	/**
	 * 1. Доступные тарифы
	 *
	 * @return TariffCodeResponse[]|null
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTariffCodes(): ?array
	{
		return $this->tariff_codes; // phpcs:ignore
	}

	/**
	 * 2. Список ошибок
	 *
	 * @return ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getErrors(): ?array
	{
		return $this->errors;
	}
}
