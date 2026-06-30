<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Service\Order;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use WishboxCdekLibrary\Event\Service\OrderStatusUpdater\AfterUpdateEvent;
use WishboxCdekLibrary\Event\Service\OrderStatusUpdater\BeforeUpdateEvent;
use WishboxCdekLibrary\Event\Service\OrderStatusUpdater\GetCdekNumbersEvent;
use WishboxCdekLibrary\Event\Service\OrderStatusUpdater\UpdateOrderStatusEvent;
use WishboxCdek\CdekClient;
use WishboxCdek\Request\Order\GetOrderByNumberRequest;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

// phpcs:disable PSR1.Files.SideEffects
require_once JPATH_SITE . '/vendor/autoload.php';
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class OrderStatusUpdaterService implements CdekClientAwareInterface
{
	use CdekClientAwareTrait;

	/**
	 * Class constructor.
	 *
	 * @param   CdekClient  $cdekClient  CDEK client
	 *
	 * @since 1.0.0
	 */
	public function __construct(CdekClient $cdekClient)
	{
		$this->setCdekClient($cdekClient);
	}

	/**
	 * @param   string     $component  Component
	 * @param   integer[]  $orderIds   Order ids
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(string $component = '', array $orderIds = []): void
	{
		$app = Factory::getApplication();

		$cdekNumbers = $this->getCdekNumbers($component, $orderIds);

		$app->enqueueMessage('Found numbers ' . count($cdekNumbers));

		/** @var BeforeUpdateEvent $beforeUpdateEvent */
		$beforeUpdateEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterBeforeUpdate',
			[
				'subject'    => $this,
				'cdekNumbers' => &$cdekNumbers,
				'eventClass'  => BeforeUpdateEvent::class,
				'component'   => $component,
				'orderIds'    => $orderIds,
			]
		);

		$app->getDispatcher()->dispatch($beforeUpdateEvent->getName(), $beforeUpdateEvent);

		foreach ($cdekNumbers as $cdekNumber)
		{
			try
			{
				$orderCdekStatuses = $this->getOrderCdekStatuses($cdekNumber);

				if (!count($orderCdekStatuses))
				{
					continue;
				}

				/** @var UpdateOrderStatusEvent $updateOrderStatusEvent */
				$updateOrderStatusEvent = AbstractEvent::create(
					'onWishboxCdekOrderStatusUpdaterUpdateOrderStatus',
					[
						'subject'           => $this,
						'cdekNumber'        => &$cdekNumber,
						'orderCdekStatuses' => $orderCdekStatuses,
						'eventClass'        => UpdateOrderStatusEvent::class,
						'component'         => $component,
						'orderIds'          => $orderIds,
					]
				);

				$app->getDispatcher()->dispatch($updateOrderStatusEvent->getName(), $updateOrderStatusEvent);
			}
			catch (Exception $e)
			{
				$app->enqueueMessage($e->getMessage(), 'warning');
			}
		}

		/** @var AfterUpdateEvent $afterUpdateEvent */
		$afterUpdateEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdate',
			[
				'subject'    => $this,
				'cdekNumbers' => &$cdekNumbers,
				'eventClass'  => AfterUpdateEvent::class,
				'component'   => $component,
				'orderIds'    => $orderIds,
			]
		);

		$app->getDispatcher()->dispatch($afterUpdateEvent->getName(), $afterUpdateEvent);
	}

	/**
	 * @param   string  $component  Component
	 * @param   array   $orderIds   Array of order ids
	 *
	 * @return string[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getCdekNumbers(string $component = '', array $orderIds = []): array
	{
		$app = Factory::getApplication();

		PluginHelper::importPlugin('wishboxcdek');

		/** @var GetCdekNumbersEvent $getCdekNumbersEvent */
		$getCdekNumbersEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterGetCdekNumbers',
			[
				'subject'    => $this,
				'eventClass' => GetCdekNumbersEvent::class,
				'component'  => $component,
				'orderIds'   => $orderIds
			]
		);

		$eventResult = $app->getDispatcher()->dispatch($getCdekNumbersEvent->getName(), $getCdekNumbersEvent);

		return $eventResult->getCdekNumbers();
	}

	/**
	 * @param   string  $cdekNumber  CDEK number
	 *
	 * @return array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getOrderCdekStatuses(string $cdekNumber): array
	{
		$orderDetails = $this->getCdekClient()
			->orders()
			->getByNumber(
				new GetOrderByNumberRequest(cdekNumber: $cdekNumber)
			);

		return $orderDetails->entity?->statuses ?? [];
	}
}
