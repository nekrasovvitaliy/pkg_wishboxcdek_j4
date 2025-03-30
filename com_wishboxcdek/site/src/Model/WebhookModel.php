<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class WebhookModel extends \Joomla\CMS\MVC\Model\BaseModel
{
	/**
	 * @param   array  $data  Data
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function orderStatus(array $data): void
	{
		$app = Factory::getApplication();

		/** @var OrderStatusEvent $event */
		$event = AbstractEvent::create(
			'onWishboxCdekWebhookOrderStatus',
			[
				'subject'   => $this,
				'data'      => $data
			]
		);

		$app->getDispatcher()->dispatch('onWishboxCdekWebhookOrderStatus', $event);
	}
}
