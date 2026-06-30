<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Factory;

use Exception;
use WishboxCdek\Request\Calculator\CalculateTariffListRequest;
use WishboxCdek\Request\Order\CreateOrderRequest;
use WishboxCdek\Request\Order\UpdateOrderRequest;
use WishboxCdekLibrary\Interface\CalculatorAdapterInterface;
use WishboxCdekLibrary\Interface\OrderRegistrationAdapterInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface defining a factory which can create Request objects
 *
 * @since  1.0.0
 */
interface RequestFactoryInterface
{
	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter
	 *
	 * @return UpdateOrderRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createUpdateOrderRequest(OrderRegistrationAdapterInterface $adapter): UpdateOrderRequest;

	/**
	 * @param   OrderRegistrationAdapterInterface  $adapter
	 *
	 * @return CreateOrderRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createCreateOrderRequest(OrderRegistrationAdapterInterface $adapter): CreateOrderRequest;

	/**
	 * @param   CalculatorAdapterInterface  $adapter
	 *
	 * @return CalculateTariffListRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createCalculateTariffListRequest(CalculatorAdapterInterface $adapter): CalculateTariffListRequest;
}
