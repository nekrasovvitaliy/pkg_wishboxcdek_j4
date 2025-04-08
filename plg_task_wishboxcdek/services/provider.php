<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Task.Wishboxcdek
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\Wishboxcdek\Site\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Task\Wishboxcdek\Extension\Wishboxcdek;

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
		$container->registerServiceProvider(new MVCFactory('Joomla\\Component\\Wishboxcdek'));

		$container->set(
			PluginInterface::class,
			function (Container $container)
			{
				$mvcFactory = $container->get(MVCFactoryInterface::class);

				$plugin = new Wishboxcdek(
					$container->get(DispatcherInterface::class),
					(array) PluginHelper::getPlugin('task', 'wishboxcdek')
				);

				$plugin->setApplication(Factory::getApplication());
				$plugin->setMVCFactory($mvcFactory);

				return $plugin;
			}
		);
	}
};
