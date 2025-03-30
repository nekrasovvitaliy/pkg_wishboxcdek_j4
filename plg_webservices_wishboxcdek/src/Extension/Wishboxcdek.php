<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Webservices\Wishboxcdek\Extension;

use Exception;
use Joomla\CMS\Event\Application\BeforeApiRouteEvent;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\SubscriberInterface;
use Joomla\Router\Route;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class Wishboxcdek extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;
	use DatabaseAwareTrait;

	/**
	 * @param   DispatcherInterface  $subject  The object to observe
	 * @param   array                $config   An optional associative array of configuration settings.
	 *                                           Recognized key values include 'name', 'group', 'params', 'language'
	 *                                           (this list is not meant to be comprehensive).
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function __construct(&$subject, $config = [])
	{
		parent::__construct($subject, $config);
	}

	/**
	 * @return string[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeApiRoute' => 'onBeforeApiRoute',
		];
	}

	/**
	 * Registers com_wishboxcdek's API's routes in the application
	 *
	 * @param   BeforeApiRouteEvent  $event  The event object
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onBeforeApiRoute(BeforeApiRouteEvent $event): void
	{
		$router = $event->getRouter();

		$route = new Route(
			['POST'],
			'v1/wishboxcdek/webhook/order-status',
			'webhook.orderStatus',
			['id'        => '(\d+)'],
			['component' => 'com_wishboxcdek']
		);

		$router->addRoute($route);
	}
}
