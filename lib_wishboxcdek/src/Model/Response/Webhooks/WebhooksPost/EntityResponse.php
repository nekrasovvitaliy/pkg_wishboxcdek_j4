<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 *
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
namespace WishboxCdekSDK2\Model\Response\Webhooks\WebhooksPost;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class EntityResponse extends AbstractResponse
{
	/**
	 * Идентификатор вебхука
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid;

	/**
	 * Тип вебхука
	 *
	 * • ORDER_STATUS - событие по статусам;
	 * • PRINT_FORM - готовность печатной формы;
	 * • PREALERT_CLOSED - получение информации о закрытии преалерта;
	 * • ACCOMPANYING_WAYBILL - получение информации о транспорте для СНТ;
	 * • OFFICE_AVAILABILITY - получение информации об изменении доступности офиса;
	 * • ORDER_MODIFIED - получение информации об изменении заказа;
	 * • DELIV_AGREEMENT - получение информации об изменении договоренности о доставке;
	 * • DELIV_PROBLEM - получение информации о проблемах доставки по заказу.
	 * Если у клиента уже есть подписка с указанным типом, то будет создана еще одна подписка с таким же типом
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $type;

	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $url;

	/**
	 * @return string
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getUuid(): string
	{
		return $this->uuid;
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
	public function getUrl(): string
	{
		return $this->url;
	}
}
