<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Service\Order;

use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on an order status updater service.
 *
 * @since  1.0.0
 */
interface OrderStatusUpdaterServiceAwareInterface
{
	/**
	 * Set the order status updater service.
	 *
	 * @param   OrderStatusUpdaterService  $orderStatusUpdaterService  The order status updater service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setOrderStatusUpdaterService(OrderStatusUpdaterService $orderStatusUpdaterService): void;
}
