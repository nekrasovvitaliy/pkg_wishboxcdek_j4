<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Console.Wishboxcdek
 *
 * @copyright   (C) 2023 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Console\Wishboxcdek\Extension\Wishboxcdek;

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
		$container->set(
			PluginInterface::class,
			function (Container $container)
			{
				$plugin = new Wishboxcdek(
					$container->get(DispatcherInterface::class),
					(array) PluginHelper::getPlugin('task', 'wishboxcdek')
				);

				$plugin->setApplication(Factory::getApplication());

				return $plugin;
			}
		);
	}
};
