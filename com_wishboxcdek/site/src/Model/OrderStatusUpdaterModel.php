<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\AfterUpdateEvent;
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\BeforeUpdateEvent;
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\UpdateOrderStatusEvent;
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\GetCdekNumbersEvent;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Exception\ApiException;
use WishboxCdekSDK2\Exception\ClientException;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\StatusResponse;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrderStatusUpdaterModel extends \Joomla\CMS\MVC\Model\BaseModel
{
	/**
	 * @param   string     $component  Component
	 * @param   integer[]  $orderIds   Order ids
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
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
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => BeforeUpdateEvent::class,
				'component'     => $component,
				'orderIds'      => $orderIds,
			]
		);

		$app->getDispatcher()->dispatch($beforeUpdateEvent->getName(), $beforeUpdateEvent);

		foreach ($cdekNumbers as $cdekNumber)
		{
			try
			{
				$orderCdekStatuses = $this->getOrderCdekStatuses($cdekNumber);

				/** @var UpdateOrderStatusEvent $event */
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
			catch (ApiException | ClientException $e)
			{
			}
		}

		/** @var AfterUpdateEvent $afterUpdateEvent */
		$afterUpdateEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdate',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => AfterUpdateEvent::class,
				'component'     => $component,
				'orderIds'      => $orderIds,
			]
		);
		$app->getDispatcher()->dispatch($afterUpdateEvent->getName(), $afterUpdateEvent);
	}

	/**
	 * @param   string  $component   Component
	 * @param   array   $orderIds    Array of order ids
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
				'subject'       => $this,
				'eventClass'    => GetCdekNumbersEvent::class,
				'component'     => $component,
				'orderIds'      => $orderIds
			]
		);

		$eventResult = $app->getDispatcher()->dispatch($getCdekNumbersEvent->getName(), $getCdekNumbersEvent);

		return $eventResult->getCdekNumbers();
	}

	/**
	 * @param   string  $cdekNumber  Cdek number
	 *
	 * @return StatusResponse[]|null
	 *
	 * @throws Exception
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
