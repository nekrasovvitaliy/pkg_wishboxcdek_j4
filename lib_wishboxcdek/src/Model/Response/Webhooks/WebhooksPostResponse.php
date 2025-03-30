<?php
/**
 * @copyright   2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Webhooks;

use WishboxCdekSDK2\Model\Response\AbstractResponse;
use WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\EntityResponse;
use WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\RequestResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class WebhooksPostResponse extends AbstractResponse
{
	/**
	 * Вебхук
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\EntityResponse
	 *
	 * @since 1.0.0
	 */
	protected EntityResponse $entity;

	/**
	 * Список запросов
	 *
	 * @var \WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost\RequestResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests = [];

	/**
	 * Вебхук
	 *
	 * @return EntityResponse
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getEntity(): EntityResponse
	{
		return $this->entity;
	}

	/**
	 * Список запросов
	 *
	 * @return RequestResponse[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getRequests(): array
	{
		return $this->requests;
	}
}
