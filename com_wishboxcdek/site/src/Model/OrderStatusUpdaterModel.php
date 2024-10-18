<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Event\GenericEvent;
use Joomla\CMS\Factory;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\StatusResponse;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class OrderStatusUpdaterModel extends \Joomla\CMS\MVC\Model\BaseModel
{
	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function updateAll(): void
	{
		$app = Factory::getApplication();

		$cdekNumbers = $this->getCdekNumbers();

		/** @var GenericEvent $eventBeforeUpdate */
		$eventBeforeUpdate = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterBeforeUpdate',
			[
				'subject'  => $this,
				'cdekNumbers' => &$cdekNumbers,
			]
		);
		$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterBeforeUpdateAll', $eventBeforeUpdate);

		foreach ($cdekNumbers as $cdekNumber)
		{
			$orderCdekStatuses = $this->getOrderCdekStatuses($cdekNumber);

			/** @var GenericEvent $event */
			$event = AbstractEvent::create(
				'onWishboxCdekOrderStatusUpdaterUpdateStatus',
				[
					'subject'           => $this,
					'cdekNumber'        => &$cdekNumber,
					'orderCdekStatuses' => $orderCdekStatuses
				]
			);
			$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterUpdateOrder', $event);
		}

		/** @var GenericEvent $eventAfterUpdate */
		$eventAfterUpdate = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdate',
			[
				'subject'  => $this,
				'cdekNumbers' => &$cdekNumbers,
			]
		);
		$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterAfterUpdate', $eventAfterUpdate);
	}

	/**
	 * @return string[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getCdekNumbers(): array
	{
		$app = Factory::getApplication();

		/** @var string[] $cdekNumbers */
		$cdekNumbers = [];

		/** @var GenericEvent $event */
		$event = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterGetCdekNumbers',
			[
				'subject'  => $this,
				'cdekNumbers' => &$cdekNumbers,
			]
		);
		$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterGetCdekNumbers', $event);

		return $event->getArgument('cdekNumbers');
	}

	/**
	 * @param   string  $cdekNumber  Cdek number
	 *
	 * @return StatusResponse[]|null
	 *
	 * @since 1.0.0
	 */
	private function getOrderCdekStatuses(string $cdekNumber): ?array
	{
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');
		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$ordersGetResponse = $apiClient->getOrderInfoByCdekNumber($cdekNumber);
		$entity = $ordersGetResponse->getEntity();

		return $entity->getStatuses();
	}
}
