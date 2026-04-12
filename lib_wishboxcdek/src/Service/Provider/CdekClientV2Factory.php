<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Service\Provider;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Service provider for the service MVC factory.
 *
 * @since  1.0.0
 */
class CdekClientV2Factory implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function register(Container $container): void
	{
		$container->set(
			CdekClientV2FactoryInterface::class,
			function (Container $container)
			{
				return new \WishboxCdekSDK2\Factory\CdekClientV2Factory;
			}
		);
	}
}
