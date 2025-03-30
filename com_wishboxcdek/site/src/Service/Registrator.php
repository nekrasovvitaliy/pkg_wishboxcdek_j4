<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use Exception;
use Joomla\CMS\Factory;
use Joomla\Component\Wishboxcdek\Site\Exception\OrdersPatchRequestErrorsException;
use Joomla\Component\Wishboxcdek\Site\Interface\RegistratorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Service\RequestCreator\OrdersPatchRequestCreator;
use Joomla\Component\Wishboxcdek\Site\Service\RequestCreator\OrdersPostRequestCreator;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use WishboxCdekSDK2\Exception\Api\RequestError\EntityNotFoundImNumberException;
use WishboxCdekSDK2\Exception\Api\RequestErrorException;
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
class Registrator
{
	use ApiClientTrait;

	/**
	 * @var RegistratorDelegateInterface $delegate
	 *
	 * @since 1.0.0
	 */
	protected RegistratorDelegateInterface $delegate;

	/**
	 * @param   RegistratorDelegateInterface  $delegate Delegate
	 *
	 * @since 1.0.0
	 */
	public function __construct(RegistratorDelegateInterface $delegate)
	{
		$this->delegate = $delegate;
	}

	/**
	 * Registers a new order or updates an existing one
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function register(): void
	{
		$orderNumber = $this->delegate->getOrderNumber();

		if (!$this->isOrderExists($orderNumber))
		{
			$this->createOrder();
		}
		else
		{
			$this->updateOrder();
		}
	}

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function createOrder(): void
	{
		$app = Factory::getApplication();

		$ordersPostRequestCreator = new OrdersPostRequestCreator($this->delegate);
		$ordersPostRequest = $ordersPostRequestCreator->getRequest();
		$apiClient = $this->getApiClient();
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
				$this->delegate->setTrackingNumber('');
				throw new Exception('CdekNumber is empty', 500);
			}

			$this->delegate->setTrackingNumber($cdekNumber);
		}
	}

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function updateOrder(): void
	{
		$ordersPatchRequestCreator = new OrdersPatchRequestCreator($this->delegate);
		$ordersPatchRequest = $ordersPatchRequestCreator->getRequest();

		$apiClient = $this->getApiClient();
		$ordersPatchResponse = $apiClient->updateOrder($ordersPatchRequest);
		$uuid = $ordersPatchResponse->getEntity()->getUuid();
		sleep(1);
		$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);

		if ($this->checkLastOrderRequest($ordersGetResponse))
		{
			if ($cdekNumber = $ordersGetResponse->getEntity()->getCdekNumber())
			{
				$this->delegate->setTrackingNumber($cdekNumber);
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
	 */
	protected function isOrderExists(string $orderNumber): bool
	{
		$apiClient = $this->getApiClient();

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
