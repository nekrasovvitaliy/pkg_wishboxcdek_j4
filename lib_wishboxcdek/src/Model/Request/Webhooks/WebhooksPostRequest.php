<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Webhooks;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class WebhooksPostRequest extends AbstractRequest
{
	/**
	 * Тип вебхука.
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
	 * URL, на который отправляется событие
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $url;

	/**
	 * @param   string  $type  Type
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setType(string $type): self
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * @param   string  $url  URL
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setUrl(string $url): self
	{
		$this->url = $url;

		return $this;
	}
}
