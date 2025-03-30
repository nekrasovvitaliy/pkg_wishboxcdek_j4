<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class RequestResponse extends AbstractResponse
{
	/**
	 * Идентификатор запроса в ИС СДЭК
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $request_uuid; // phpcs:ignore

	/**
	 * Тип запроса
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * Дата и время установки текущего статуса запроса
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $date_time; // phpcs:ignore

	/**
	 * Текущее состояние запроса
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $state; // phpcs:ignore

	/**
	 * Ошибки, возникшие в ходе выполнения запроса
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\Request\ErrorResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $errors;

	/**
	 * @return string
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRequestUuid(): string
	{
		return $this->request_uuid; // phpcs:ignore
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDateTime(): string
	{
		return $this->date_time; // phpcs:ignore
	}

	/**
	 * @return \WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\Request\ErrorResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}
}
