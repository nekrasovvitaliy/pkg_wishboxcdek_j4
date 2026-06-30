<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\Order;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for an OrderStatusUpdaterService aware class.
 *
 * @since  1.0.0
 */
trait OrderStatusUpdaterServiceAwareTrait
{
	/**
	 * The order status updater service.
	 *
	 * @var    OrderStatusUpdaterService|null
	 *
	 * @since  1.0.0
	 */
	private ?OrderStatusUpdaterService $orderStatusUpdaterService = null;

	/**
	 * Get the order status updater service.
	 *
	 * @return  OrderStatusUpdaterService
	 *
	 * @throws  UnexpectedValueException  May be thrown if the OrderStatusUpdaterService has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getOrderStatusUpdaterService(): OrderStatusUpdaterService
	{
		if ($this->orderStatusUpdaterService)
		{
			return $this->orderStatusUpdaterService;
		}

		throw new UnexpectedValueException('OrderStatusUpdaterService not set in ' . __CLASS__);
	}

	/**
	 * Set the order status updater service to use.
	 *
	 * @param   OrderStatusUpdaterService  $orderStatusUpdaterService  The order status updater service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setOrderStatusUpdaterService(OrderStatusUpdaterService $orderStatusUpdaterService): void
	{
		$this->orderStatusUpdaterService = $orderStatusUpdaterService;
	}
}
