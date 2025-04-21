<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPost\Request\ErrorResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPost\Request\WarningResponse;


/**
 * Информация о запросе/запросах над заказом
 *
 * @since 1.0.0
 */
class RequestResponse extends AbstractResponse
{
	/**
	 * 2.1. Идентификатор запроса в ИС СДЭК
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $request_uuid = null; // phpcs:ignore

	/**
	 * 2.2. Тип запроса
	 *
	 * Может принимать значения: CREATE, UPDATE, DELETE, AUTH, GET
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * 2.3. Дата и время установки текущего состояния запроса (формат yyyy-MM-dd'T'HH:mm:ssZ)
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * 2.4. Текущее состояние запроса
	 *
	 * Может принимать значения:
	 * ACCEPTED - пройдена предварительная валидация и запрос принят
	 * WAITING - запрос ожидает обработки (зависит от выполнения другого запроса)
	 * SUCCESSFUL - запрос обработан успешно
	 * INVALID - запрос обработался с ошибкой
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $state;

	/**
	 * 2.5. Ошибки, возникшие в ходе выполнения запроса
	 *
	 * @var ErrorResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $errors = null;

	/**
	 * 2.6. Предупреждения, возникшие в ходе выполнения запроса.
	 *
	 * @var WarningResponse[]|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $warnings = null;

	/**
	 * 2.1. Получить идентификатор запроса в ИС СДЭК.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRequestUuid(): ?string
	{
		return $this->request_uuid; // phpcs:ignore
	}

	/**
	 * 2.2. Тип запроса
	 *
	 * Может принимать значения: CREATE, UPDATE, DELETE, AUTH, GET
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * 2.3. Дата и время установки текущего состояния запроса (формат yyyy-MM-dd'T'HH:mm:ssZ)
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getDateTime(): string
	{
		return $this->date_time; // phpcs:ignore
	}

	/**
	 * 2.4. Текущее состояние запроса
	 *
	 *  Может принимать значения:
	 *  ACCEPTED - пройдена предварительная валидация и запрос принят
	 *  WAITING - запрос ожидает обработки (зависит от выполнения другого запроса)
	 *  SUCCESSFUL - запрос обработан успешно
	 *  INVALID - запрос обработался с ошибкой
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getState(): string
	{
		return $this->state;
	}

	/**
	 * Получить ошибки, возникшие в ходе выполнения запроса.
	 *
	 * @return array|null
	 *
	 * @since 1.0.0
	 */
	public function getErrors(): ?array
	{
		return $this->errors;
	}

	/**
	 * 2.6. Получить предупреждения, возникшие в ходе выполнения запроса.
	 *
	 * @return WarningResponse[]|null
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWarnings(): ?array
	{
		return $this->warnings;
	}
}
