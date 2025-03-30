<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wishboxcdek\Site\CMS\Extension\Service\Provider;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Mail\MailerFactoryInterface;
use Joomla\CMS\MVC\Factory\ApiMVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\SiteRouter;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Service provider for the service MVC factory.
 *
 * @since  4.0.0
 */
class MVCFactory extends \Joomla\CMS\Extension\Service\Provider\MVCFactory implements ServiceProviderInterface
{
	/**
	 * The extension namespace
	 *
	 * @var  string
	 *
	 * @since   4.0.0
	 */
	private $namespace;

	/**
	 * MVCFactory constructor.
	 *
	 * @param   string  $namespace  The namespace
	 *
	 * @since   4.0.0
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
	 * @since   1.0.0
	 */
	public function register(Container $container)
	{
		$container->set(
			MVCFactoryInterface::class,
			function (Container $container)
			{
				if (Factory::getApplication()->isClient('api'))
				{
					$factory = new ApiMVCFactory($this->namespace);
				}
				else
				{
					$factory = new \Joomla\Component\Wishboxcdek\Site\CMS\MVC\Factory\MVCFactory($this->namespace);
				}

				$factory->setFormFactory($container->get(FormFactoryInterface::class));
				$factory->setDispatcher($container->get(DispatcherInterface::class));
				$factory->setDatabase($container->get(DatabaseInterface::class));
				$factory->setSiteRouter($container->get(SiteRouter::class));
				$factory->setCacheControllerFactory($container->get(CacheControllerFactoryInterface::class));
				$factory->setUserFactory($container->get(UserFactoryInterface::class));
				$factory->setMailerFactory($container->get(MailerFactoryInterface::class));

				return $factory;
			}
		);
	}
}
