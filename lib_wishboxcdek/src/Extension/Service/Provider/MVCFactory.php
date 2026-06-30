<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Extension\Service\Provider;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Mail\MailerFactoryInterface;
use Joomla\CMS\MVC\Factory\ApiMVCFactory as JoomlaApiMVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\SiteRouter;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use WishboxCdek\CdekClient;
use WishboxCdekLibrary\Factory\RequestFactoryInterface;
use WishboxCdekLibrary\MVC\Factory\ControllerServiceAwareMVCFactoryDecorator;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use WishboxCdekLibrary\Service\City\CitiesUpdaterService;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterService;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterService;
use WishboxCdekLibrary\Service\Webhook\WebhookService;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Service provider for the service MVC factory.
 *
 * @since  1.0.0
 */
class MVCFactory extends \Joomla\CMS\Extension\Service\Provider\MVCFactory implements ServiceProviderInterface
{
	use CdekClientAwareTrait;

	/**
	 * The extension namespace
	 *
	 * @var  string
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpMissingFieldTypeInspection
	 */
	private $namespace;

	/**
	 * MVCFactory constructor.
	 *
	 * @param   string  $namespace  The namespace
	 *
	 * @since   1.0.0
	 */
	public function __construct(string $namespace)
	{
		parent::__construct($namespace);

		$this->namespace = $namespace;
	}

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since        1.0.0
	 */
	public function register(Container $container): void
	{
		$container->set(
			MVCFactoryInterface::class,
			function (Container $container) {
				if (Factory::getApplication()->isClient('api'))
				{
					$factory = new JoomlaApiMVCFactory($this->namespace);
				}
				else
				{
					$factory = new \WishboxCdekLibrary\MVC\Factory\MVCFactory($this->namespace);
				}

				$this->setJoomlaMVCFactoryDependencies($factory, $container);
				$this->setWishboxCdekServices($factory, $container);

				$decoratedFactory = new ControllerServiceAwareMVCFactoryDecorator($factory);
				$this->setWishboxCdekServices($decoratedFactory, $container);

				return $decoratedFactory;
			}
		);
	}

	/**
	 * Set Joomla framework dependencies on MVC factory.
	 *
	 * @param   object     $factory    MVC factory
	 * @param   Container  $container  DI container
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	private function setJoomlaMVCFactoryDependencies(object $factory, Container $container): void
	{
		$dependencies = [
			'setFormFactory'            => FormFactoryInterface::class,
			'setDispatcher'             => DispatcherInterface::class,
			'setDatabase'               => DatabaseInterface::class,
			'setSiteRouter'             => SiteRouter::class,
			'setCacheControllerFactory' => CacheControllerFactoryInterface::class,
			'setUserFactory'            => UserFactoryInterface::class,
			'setMailerFactory'          => MailerFactoryInterface::class,
			'setRequestFactory'         => RequestFactoryInterface::class,
			'setCdekClient'             => CdekClient::class,
		];

		foreach ($dependencies as $method => $service)
		{
			if (method_exists($factory, $method))
			{
				$factory->$method($container->get($service));
			}
		}
	}

	/**
	 * Set Wishbox CDEK services on MVC factory.
	 *
	 * @param   object     $factory    MVC factory
	 * @param   Container  $container  DI container
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	private function setWishboxCdekServices(object $factory, Container $container): void
	{
		$services = [
			'setCitiesUpdaterService'      => CitiesUpdaterService::class,
			'setOfficesUpdaterService'     => OfficesUpdaterService::class,
			'setOrderStatusUpdaterService' => OrderStatusUpdaterService::class,
			'setWebhookService'            => WebhookService::class,
		];

		foreach ($services as $method => $service)
		{
			if (method_exists($factory, $method) && $container->has($service))
			{
				$factory->$method($container->get($service));
			}
		}
	}
}
