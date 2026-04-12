<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\WishboxCdek\Administrator\Factory;

use Exception;
use Joomla\Component\WishboxCdek\Site\Interface\CalculatorDelegateInterface;
use Joomla\Component\WishboxCdek\Site\Interface\RegistratorDelegateInterface;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPostRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatchRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPostRequest;
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
	 * @param   RegistratorDelegateInterface  $delegate
	 *
	 * @return OrdersPatchRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createOrdersPatchRequest(RegistratorDelegateInterface $delegate): OrdersPatchRequest;

	/**
	 * @param   RegistratorDelegateInterface  $delegate
	 *
	 * @return OrdersPostRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createOrdersPostRequest(RegistratorDelegateInterface $delegate): OrdersPostRequest;

	/**
	 * @param   CalculatorDelegateInterface  $delegate
	 *
	 * @return TariffListPostRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function createTariffListPostRequest(CalculatorDelegateInterface $delegate): TariffListPostRequest;
}
