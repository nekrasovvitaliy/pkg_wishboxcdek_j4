<?php
/**
 * @copyright   (с) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\WishboxCdek\Administrator\Extension\Service\Provider\MVCFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Console\WishboxCdek\Extension\WishboxCdek;
use WishboxCdekSDK2\Service\Provider\CdekClientV2Factory;

defined('_JEXEC') or die;

return new class implements ServiceProviderInterface
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
		$container->registerServiceProvider(new CdekClientV2Factory);
		$container->registerServiceProvider(new MVCFactory('Joomla\\Component\\WishboxCdek'));

		$container->set(
			PluginInterface::class,
			function (Container $container)
			{
				$dispatcher = $container->get(DispatcherInterface::class);
				$config = (array) PluginHelper::getPlugin('console', 'wishboxcdek');
				$mvcFactory = $container->get(MVCFactoryInterface::class);

				$plugin = new WishboxCdek(
					$dispatcher,
					$config
				);

				$plugin->setApplication(Factory::getApplication());
				$plugin->setMVCFactory($mvcFactory);

				return $plugin;
			}
		);
	}
};
