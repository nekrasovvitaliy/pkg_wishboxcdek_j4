<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

/**
 * @since 1.0.0
 */
class Webhooks extends Source
{
	/**
	 * Тип события.
	 *
	 * @var string
	 */
	public $type;

	/**
	 * URL клиента для получения webhook.
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Установить параметр - uRL клиента для получения webhook.
	 *
	 * @param   string $url URL клиента для получения webhook
	 *
	 * @return self
	 */
	public function setUrl(string $url)
	{
		$this->url = $url;

		return $this;
	}

	/**
	 * Установить параметр - тип события.
	 *
	 * @param   string $type
	 *                     Тип события:
	 *                     'ORDER_STATUS' - событие по статусам
	 *                     'PRINT_FORM' - готовность печатной формы
	 *
	 * @return self
	 */
	public function setType(string $type)
	{
		$this->type = $type;

		return $this;
	}
}
