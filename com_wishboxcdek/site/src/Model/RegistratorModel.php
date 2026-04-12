<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\WishboxCdek\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactoryAwareInterface;
use Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactoryAwareTrait;
use Joomla\Component\WishboxCdek\Site\Exception\OrdersPatchRequestErrorsException;
use Joomla\Component\WishboxCdek\Site\Interface\RegistratorDelegateInterface;
use WishboxCdekSDK2\Exception\Api\RequestError\EntityNotFoundImNumberException;
use WishboxCdekSDK2\Exception\Api\RequestErrorException;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareInterface;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGetResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class RegistratorModel extends BaseDatabaseModel implements CdekClientV2FactoryAwareInterface, RequestFactoryAwareInterface
{
	use CdekClientV2FactoryAwareTrait;
	use RequestFactoryAwareTrait;

	/**
	 * Registers a new order or updates an existing one
	 *
	 * @param   RegistratorDelegateInterface  $delegate  Delegate
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function register(RegistratorDelegateInterface $delegate): void
	{
		$orderNumber = $delegate->getOrderNumber();

		if (!$this->isOrderExists($orderNumber))
		{
			$this->createOrder($delegate);
		}
		else
		{
			$this->updateOrder($delegate);
		}
	}

	/**
	 * @param   RegistratorDelegateInterface  $delegate  Delegate
	 *
	 * @return void
	 *
	 * @throws OrdersPatchRequestErrorsException
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function createOrder(RegistratorDelegateInterface $delegate): void
	{
		$app = Factory::getApplication();

		$ordersPostRequest = $this->getRequestFactory()->createOrdersPostRequest($delegate);
		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();
		$ordersPostResponse = $apiClient->createOrder($ordersPostRequest);
		$uuid = $ordersPostResponse->getEntity()->getUuid();

		$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);
		$this->checkLastOrderRequest($ordersGetResponse);
		$app->enqueueMessage($ordersGetResponse->getRequests()[0]->getState());

		if ($ordersGetResponse->getRequests()[0]->getState() == 'ACCEPTED')
		{
			sleep(3);
			$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);
			$this->checkLastOrderRequest($ordersGetResponse);
			$app->enqueueMessage($ordersGetResponse->getRequests()[0]->getState());
		}

		if ($ordersGetResponse->getRequests()[0]->getState() == 'ACCEPTED')
		{
			sleep(3);
			$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);
			$this->checkLastOrderRequest($ordersGetResponse);
			$app->enqueueMessage($ordersGetResponse->getRequests()[0]->getState());
		}

		if ($this->checkLastOrderRequest($ordersGetResponse))
		{
			$cdekNumber = $ordersGetResponse->getEntity()->getCdekNumber();

			if (!$cdekNumber)
			{
				$delegate->setTrackingNumber('');
				throw new Exception('CdekNumber is empty', 500);
			}

			$delegate->setTrackingNumber($cdekNumber);
		}
	}

	/**
	 * @param   RegistratorDelegateInterface  $delegate  Delegate
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @throws OrdersPatchRequestErrorsException
	 *
	 * @since 1.0.0
	 */
	private function updateOrder(RegistratorDelegateInterface $delegate): void
	{
		$ordersPatchRequest = $this->getRequestFactory()->createOrdersPatchRequest($delegate);
		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();
		$ordersPatchResponse = $apiClient->updateOrder($ordersPatchRequest);
		$uuid = $ordersPatchResponse->getEntity()->getUuid();
		sleep(1);
		$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);

		if ($this->checkLastOrderRequest($ordersGetResponse))
		{
			if ($cdekNumber = $ordersGetResponse->getEntity()->getCdekNumber())
			{
				$delegate->setTrackingNumber($cdekNumber);
			}
		}
	}

	/**
	 * @param   OrdersGetResponse  $ordersGetResponse  Orders get response
	 *
	 * @return boolean
	 *
	 * @throws OrdersPatchRequestErrorsException
	 *
	 * @since 1.0.0
	 */
	protected function checkLastOrderRequest(OrdersGetResponse $ordersGetResponse): bool
	{
		$ordersGetResponseRequests = $ordersGetResponse->getRequests();
		$lastRequest = $ordersGetResponseRequests[0];
		$lastRequestErrors = $lastRequest->getErrors();

		if (is_array($lastRequestErrors) && count($lastRequestErrors))
		{
			throw new OrdersPatchRequestErrorsException($lastRequestErrors);
		}

		return true;
	}

	/**
	 * @param   string  $orderNumber  Order number
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnusedLocalVariableInspection
	 */
	protected function isOrderExists(string $orderNumber): bool
	{
		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();

		try
		{
			$ordersGetResponse = $apiClient->getOrderInfoByImNumber($orderNumber);
			$statuses = $ordersGetResponse->getEntity()->getStatuses();

			foreach ($statuses as $status)
			{
				if ($status->getCode() == 'CREATED')
				{
					return true;
				}
			}

			return false;
		}
		catch (EntityNotFoundImNumberException $e)
		{
			return false;
		}
		catch (RequestErrorException $e)
		{
			return true;
		}
	}
}
