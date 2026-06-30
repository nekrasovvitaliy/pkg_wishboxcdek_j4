<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\Webhook;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a WebhookService aware class.
 *
 * @since  1.0.0
 */
trait WebhookServiceAwareTrait
{
	/**
	 * The webhook service.
	 *
	 * @var    WebhookService|null
	 *
	 * @since  1.0.0
	 */
	private ?WebhookService $webhookService = null;

	/**
	 * Get the webhook service.
	 *
	 * @return  WebhookService
	 *
	 * @throws  UnexpectedValueException  May be thrown if the WebhookService has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getWebhookService(): WebhookService
	{
		if ($this->webhookService)
		{
			return $this->webhookService;
		}

		throw new UnexpectedValueException('WebhookService not set in ' . __CLASS__);
	}

	/**
	 * Set the webhook service to use.
	 *
	 * @param   WebhookService  $webhookService  The webhook service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setWebhookService(WebhookService $webhookService): void
	{
		$this->webhookService = $webhookService;
	}
}
