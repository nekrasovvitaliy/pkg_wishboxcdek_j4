<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\WishboxCdek\Administrator\Extension\Service\Provider;

use Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryInterface;
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
	 * @since   1.0.0
	 */
	public function register(Container $container): void
	{
		$container->set(
			RequestFactoryInterface::class,
			function (Container $container)
			{
				$factory = new \Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactory;
				$factory->setCdekClientV2Factory($container->get(CdekClientV2FactoryInterface::class));

				return $factory;
			}
		);
	}
}
