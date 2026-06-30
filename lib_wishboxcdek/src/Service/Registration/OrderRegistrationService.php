<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later
 */

namespace WishboxCdekLibrary\Service\Registration;

use Exception;
use WishboxCdek\Exception\ApiResponseException;
use WishboxCdek\Exception\HttpException;
use WishboxCdek\Request\Order\GetOrderByNumberRequest;
use WishboxCdek\Response\Order\OrderDetails;
use WishboxCdekLibrary\Exception\Order\OrderRequestErrorsException;
use WishboxCdekLibrary\Factory\RequestFactoryAwareInterface;
use WishboxCdekLibrary\Factory\RequestFactoryAwareTrait;
use WishboxCdekLibrary\Interface\OrderRegistrationAdapterInterface;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since        1.0.0
 *
 * @noinspection PhpUnused
 */
class OrderRegistrationService implements CdekClientAwareInterface, RequestFactoryAwareInterface
{
	use CdekClientAwareTrait;
	use RequestFactoryAwareTrait;

	/**
	 * Registers a new order or updates an existing one
	 *
	 * @param   OrderRegistrationAdapterInterface  $adapter  Adapter
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function register(OrderRegistrationAdapterInterface $adapter): void
	{
		$orderNumber = $adapter->getOrderNumber();

		if (!$this->isOrderExists($orderNumber))
		{
			$this->createOrder($adapter);
		}
		else
		{
			$this->updateOrder($adapter);
		}
	}

	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter  Adapter
	 *
	 * @return void
	 *
	 * @throws OrderRequestErrorsException
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function createOrder(OrderRegistrationAdapterInterface $adapter): void
	{
		$createOrderRequest = $this->getRequestFactory()->createCreateOrderRequest($adapter);
		$apiClient          = $this->getCdekClient();
		$asyncResponse      = $apiClient->orders()->create($createOrderRequest);
		$uuid               = $asyncResponse->entity->uuid;

		$orderDetails = $apiClient->orders()->getByUuid($uuid);
		$this->checkLastOrderRequest($orderDetails);

		for ($i = 0; $i < 2 && ($orderDetails->requests[0]->state ?? '') == 'ACCEPTED'; $i++)
		{
			sleep(3);
			$orderDetails = $apiClient->orders()->getByUuid($uuid);
			$this->checkLastOrderRequest($orderDetails);
		}

		$this->checkLastOrderRequest($orderDetails);

		if (!$orderDetails->entity?->cdekNumber)
		{
			$adapter->setTrackingNumber('');
			throw new Exception('CdekNumber is empty', 500);
		}

		$adapter->setTrackingNumber($orderDetails->entity->cdekNumber);
	}

	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter  Adapter
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @throws OrderRequestErrorsException
	 *
	 * @since 1.0.0
	 */
	private function updateOrder(OrderRegistrationAdapterInterface $adapter): void
	{
		$updateOrderRequest = $this->getRequestFactory()->createUpdateOrderRequest($adapter);
		$apiClient          = $this->getCdekClient();
		$asyncResponse      = $apiClient->orders()->update($updateOrderRequest);
		$uuid               = $asyncResponse->entity->uuid;
		sleep(1);
		$orderDetails = $apiClient->orders()->getByUuid($uuid);

		$this->checkLastOrderRequest($orderDetails);

		if ($cdekNumber = $orderDetails->entity?->cdekNumber)
		{
			$adapter->setTrackingNumber($cdekNumber);
		}
	}

	/**
	 * @param   OrderDetails  $orderDetails  Order details
	 *
	 * @return void
	 *
	 * @throws OrderRequestErrorsException
	 *
	 * @since 1.0.0
	 */
	protected function checkLastOrderRequest(OrderDetails $orderDetails): void
	{
		$errors = $orderDetails->getErrors();

		if (count($errors))
		{
			throw new OrderRequestErrorsException($errors);
		}
	}

	/**
	 * @param   string  $orderNumber  Order number
	 *
	 * @return boolean
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnusedLocalVariableInspection
	 */
	protected function isOrderExists(string $orderNumber): bool
	{
		$apiClient = $this->getCdekClient();

		try
		{
			$orderDetails = $apiClient->orders()
				->getByNumber(new GetOrderByNumberRequest(imNumber: $orderNumber));
			$statuses     = $orderDetails->entity?->statuses ?? [];

			return array_any(
				$statuses,
				fn($status) => $status->code == 'CREATED'
			);

		}
		catch (HttpException $e)
		{
			return $e->getStatusCode() != 404;
		}
		catch (ApiResponseException $e)
		{
			return true;
		}
	}
}
