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
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\AfterUpdateAllEvent;
use Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater\BeforeUpdateAllEvent;
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

		$app->enqueueMessage('Found numbers ' . count($cdekNumbers));

		/** @var BeforeUpdateAllEvent $beforeUpdateAllEvent */
		$beforeUpdateAllEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterBeforeUpdateAll',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => BeforeUpdateAllEvent::class
			]
		);

		$app->getDispatcher()->dispatch($beforeUpdateAllEvent->getName(), $beforeUpdateAllEvent);

		$this->update($cdekNumbers);

		/** @var AfterUpdateAllEvent $afterUpdateAllEvent */
		$afterUpdateAllEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdateAll',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => AfterUpdateAllEvent::class
			]
		);
		$app->getDispatcher()->dispatch($afterUpdateAllEvent->getName(), $afterUpdateAllEvent);
	}

	/**
	 * @param   integer[]  $cdekNumbers  Array of Cdek numbers
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function update(array $cdekNumbers): void
	{
		$app = Factory::getApplication();

		/** @var BeforeUpdateEvent $beforeUpdateEvent */
		$beforeUpdateEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterBeforeUpdate',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => BeforeUpdateEvent::class
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
						'eventClass'        => UpdateOrderStatusEvent::class
					]
				);

				$app->getDispatcher()->dispatch($updateOrderStatusEvent->getName(), $updateOrderStatusEvent);
			}
			catch (ApiException | ClientException $e)
			{
			}
		}

		/** @var AfterUpdateAllEvent $afterUpdateAllEvent */
		$afterUpdateAllEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdate',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => AfterUpdateAllEvent::class
			]
		);

		$app->getDispatcher()->dispatch($afterUpdateAllEvent->getName(), $afterUpdateAllEvent);
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

		PluginHelper::importPlugin('wishboxcdek');

		/** @var GetCdekNumbersEvent $getCdekNumbersEvent */
		$getCdekNumbersEvent = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterGetCdekNumbers',
			[
				'subject'       => $this,
				'eventClass'    => GetCdekNumbersEvent::class
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
