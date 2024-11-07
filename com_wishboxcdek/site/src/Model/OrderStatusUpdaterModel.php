<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\Wishboxcdek\Administrator\Event\Model\OrderStatusUpdater\AfterUpdateAllEvent;
use Joomla\Component\Wishboxcdek\Administrator\Event\Model\OrderStatusUpdater\UpdateOrderStatusEvent;
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

		/** @var AfterUpdateAllEvent $eventBeforeUpdateAll */
		$eventBeforeUpdateAll = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterBeforeUpdateAll',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => AfterUpdateAllEvent::class
			]
		);

		$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterBeforeUpdateAll', $eventBeforeUpdateAll);

		foreach ($cdekNumbers as $componentName => $componentCdekNumbers)
		{
			foreach ($componentCdekNumbers as $cdekNumber)
			{
				try
				{
					$orderCdekStatuses = $this->getOrderCdekStatuses($cdekNumber);

					/** @var UpdateOrderStatusEvent $event */
					$event = AbstractEvent::create(
						'onWishboxCdekOrderStatusUpdaterUpdateOrderStatus',
						[
							'subject'           => $this,
							'cdekNumber'        => &$cdekNumber,
							'orderCdekStatuses' => $orderCdekStatuses,
							'eventClass'        => UpdateOrderStatusEvent::class
						]
					);

					$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterUpdateOrderStatus', $event);
				}
				catch (ApiException|ClientException $e)
				{
				}
			}
		}

		/** @var AfterUpdateAllEvent $eventAfterUpdateAll */
		$eventAfterUpdateAll = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterAfterUpdateAll',
			[
				'subject'       => $this,
				'cdekNumbers'   => &$cdekNumbers,
				'eventClass'    => AfterUpdateAllEvent::class
			]
		);
		$app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterAfterUpdateAll', $eventAfterUpdateAll);
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

		/** @var GetCdekNumbersEvent $event */
		$event = AbstractEvent::create(
			'onWishboxCdekOrderStatusUpdaterGetCdekNumbers',
			[
				'subject'       => $this,
				'eventClass'    => GetCdekNumbersEvent::class
			]
		);

		$eventResult = $app->getDispatcher()->dispatch('onWishboxCdekOrderStatusUpdaterGetCdekNumbers', $event);

		return $eventResult->getResult();
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
