<?php
/**
 * @copyright   (с) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Webservices\Wishboxcdek\Extension\Wishboxcdek;

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
		$container->registerServiceProvider(new MVCFactory('Joomla\\Plugin\\Webservices\\Wishboxcdek'));

		$container->set(
			PluginInterface::class,
			function (Container $container)
			{
				$config = (array) PluginHelper::getPlugin('webservices', 'wishboxcdek');
				$subject = $container->get(DispatcherInterface::class);
				$mvcFactory = $container->get(MVCFactoryInterface::class);

				$plugin = new Wishboxcdek(
					$subject,
					$config
				);
				$app = Factory::getApplication();
				$plugin->setApplication($app);
				$plugin->setMVCFactory($mvcFactory);

				return $plugin;
			}
		);
	}
};
