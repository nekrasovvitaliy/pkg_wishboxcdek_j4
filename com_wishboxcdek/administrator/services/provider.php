<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

use GuzzleHttp\Psr7\HttpFactory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\WishboxCdek\Administrator\Extension\WishboxCdekComponent;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Symfony\Component\HttpClient\Psr18Client;
use WishboxCdek\CdekClient;
use WishboxCdekLibrary\Extension\Service\Provider\MVCFactory;
use WishboxCdekLibrary\Extension\Service\Provider\RequestFactory;
use WishboxCdekLibrary\Factory\RequestFactoryInterface;
use WishboxCdekLibrary\Service\Calculator\CalculatorService;
use WishboxCdekLibrary\Service\City\CitiesUpdaterService;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterService;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterService;
use WishboxCdekLibrary\Service\Registration\OrderRegistrationService;
use WishboxCdekLibrary\Service\Webhook\WebhookService;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

require_once JPATH_SITE . '/vendor/autoload.php';

/**
 * The WishboxCdek service provider.
 *
 * @since  1.0.0
 */
return new class () implements ServiceProviderInterface {
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 * @noinspection PhpUnusedParameterInspection
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	public function register(Container $container)
	{
		$container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\WishboxCdek'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\WishboxCdek'));
		$container->registerServiceProvider(new RouterFactory('\\Joomla\\Component\\WishboxCdek'));

		$container->registerServiceProvider(new RequestFactory);
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

				$cdekClient = new CdekClient(
					$psr18,
					$httpFactory,
					$httpFactory,
					[
						'base_url' => $baseUrl,
						'account'  => $account,
						'password' => $password,
					]
				);

				return $cdekClient;
			}
		);

		$container->set(
			CalculatorService::class,
			function (Container $container) {
				return new CalculatorService(
					$container->get(DatabaseInterface::class),
					$container->get(CdekClient::class),
					$container->get(RequestFactoryInterface::class)
				);
			}
		);

		$container->set(
			CitiesUpdaterService::class,
			function (Container $container) {
				return new CitiesUpdaterService(
					$container->get(DatabaseInterface::class),
					$container->get(CdekClient::class)
				);
			}
		);

		$container->set(
			OfficesUpdaterService::class,
			function (Container $container) {
				return new OfficesUpdaterService(
					$container->get(DatabaseInterface::class),
					$container->get(CdekClient::class),
					$container->get(DispatcherInterface::class)
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
			OrderRegistrationService::class,
			function (Container $container) {
				$orderRegistrationService = new OrderRegistrationService;
				$orderRegistrationService->setCdekClient($container->get(CdekClient::class));
				$orderRegistrationService->setRequestFactory($container->get(RequestFactoryInterface::class));

				return $orderRegistrationService;
			}
		);

		$container->set(
			WebhookService::class,
			function (Container $container) {
				return new WebhookService();
			}
		);

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$dispatcher = $container->get(ComponentDispatcherFactoryInterface::class);
				$component  = new WishboxCdekComponent($dispatcher);
				$component->setRegistry($container->get(Registry::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
				$component->setRouterFactory($container->get(RouterFactoryInterface::class));
				$component->setCitiesUpdaterService($container->get(CitiesUpdaterService::class));
				$component->setOfficesUpdaterService($container->get(OfficesUpdaterService::class));
				$component->setOrderStatusUpdaterService($container->get(OrderStatusUpdaterService::class));
				$component->setWebhookService($container->get(WebhookService::class));

				return $component;
			}
		);
	}
};
