<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace WishboxCdekLibrary\Service\Webhook;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use WishboxCdekLibrary\Event\Webhook\HandleOrderStatusEvent;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class WebhookService
{
	/**
	 * @param   array  $data  Webhook payload
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function handleOrderStatus(array $data): void
	{
		$app = Factory::getApplication();

		/** @var HandleOrderStatusEvent $event */
		$event = AbstractEvent::create(
			'onWishboxCdekWebhookHandleOrderStatus',
			[
				'subject'    => $this,
				'data'       => $data,
				'eventClass' => HandleOrderStatusEvent::class,
			]
		);

		$app->getDispatcher()->dispatch($event->getName(), $event);
	}
}
