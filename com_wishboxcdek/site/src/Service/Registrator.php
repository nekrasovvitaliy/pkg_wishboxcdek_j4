<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use Exception;
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
		$ordersPostRequestCreator = new OrdersPostRequestCreator($this->delegate);
		$ordersPostRequest = $ordersPostRequestCreator->getRequest();
		$apiClient = $this->getApiClient();
		$ordersPostResponse = $apiClient->createOrder($ordersPostRequest);
		$uuid = $ordersPostResponse->getEntity()->getUuid();
		$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);
		$this->checkLastOrderRequest($ordersGetResponse);
		$this->delegate->setTrackingNumber($ordersGetResponse->getEntity()->getCdekNumber());
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

		$ordersGetResponse = $apiClient->getOrderInfoByUuid($uuid);
		$this->checkLastOrderRequest($ordersGetResponse);
		$this->delegate->setTrackingNumber($ordersGetResponse->getEntity()->getCdekNumber());
	}

	/**
	 * @param   OrdersGetResponse  $ordersGetResponse  Orders get response
	 *
	 * @return void
	 *
	 * @throws OrdersPatchRequestErrorsException
	 *
	 * @since 1.0.0
	 */
	protected function checkLastOrderRequest(OrdersGetResponse $ordersGetResponse): void
	{
		$ordersGetResponseRequests = $ordersGetResponse->getRequests();
		$lastRequest = $ordersGetResponseRequests[0];
		$lastRequestErrors = $lastRequest->getErrors();

		if (is_array($lastRequestErrors) && count($lastRequestErrors))
		{
			throw new OrdersPatchRequestErrorsException($lastRequestErrors);
		}
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
