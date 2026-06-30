<?php
/**
 * @copyright   (с) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

use GuzzleHttp\Psr7\HttpFactory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Console\WishboxCdek\Extension\WishboxCdek;
use Symfony\Component\HttpClient\Psr18Client;
use WishboxCdek\CdekClient;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterService;

defined('_JEXEC') or die;

return new class implements ServiceProviderInterface {
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function register(Container $container): void
	{
		$container->registerServiceProvider(new MVCFactory('Joomla\\Component\\WishboxCdek'));

		$container->set(
			CdekClient::class,
			function (Container $container) {
				$componentParams = ComponentHelper::getParams('com_wishboxcdek');

				$baseUrl  = 'https://api.cdek.ru/';
				$account  = $componentParams->get('account', '');
				$password = $componentParams->get('secure', '');

				$httpFactory = new HttpFactory();
				$psr18       = new Psr18Client(null, $httpFactory, $httpFactory);

				require_once JPATH_SITE . '/vendor/autoload.php';

				return new CdekClient(
					$psr18,
					$httpFactory,
					$httpFactory,
					[
						'base_url' => $baseUrl,
						'account'  => $account,
						'password' => $password,
					]
				);
			}
		);

		$container->set(
			OrderStatusUpdaterService::class,
			function (Container $container) {
				return new OrderStatusUpdaterService(
					$container->get(CdekClient::class)
				);
			}
		);

		$container->set(
			PluginInterface::class,
			function (Container $container) {
				$dispatcher = $container->get(DispatcherInterface::class);
				$config     = (array) PluginHelper::getPlugin('console', 'wishboxcdek');

				$plugin = new WishboxCdek(
					$dispatcher,
					$config
				);

				$plugin->setApplication(Factory::getApplication());
				$plugin->setCdekClient($container->get(CdekClient::class));

				return $plugin;
			}
		);
	}
};
