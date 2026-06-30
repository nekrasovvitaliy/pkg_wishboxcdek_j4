<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Extension\Service\Provider;

use WishboxCdekLibrary\Factory\RequestFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Service provider for the service Request factory.
 *
 * @since  1.0.0
 */
class RequestFactory implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnusedParameterInspection
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	public function register(Container $container): void
	{
		$container->set(
			RequestFactoryInterface::class,
			function (Container $container) {
				$factory = new \WishboxCdekLibrary\Factory\RequestFactory;

				return $factory;
			}
		);
	}
}
