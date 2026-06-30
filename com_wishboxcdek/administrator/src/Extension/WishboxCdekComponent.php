<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace Joomla\Component\WishboxCdek\Administrator\Extension;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;

// phpcs:enable PSR1.Files.SideEffects

use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\Component\WishboxCdek\Administrator\Service\HTML\AdministratorService;
use Joomla\Database\DatabaseAwareTrait;
use Psr\Container\ContainerInterface;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use WishboxCdekLibrary\Service\City\CitiesUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\City\CitiesUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareInterface;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareTrait;
use function defined;

/**
 * Component class for WishboxCdek
 *
 * @since  1.0.0
 */
class WishboxCdekComponent extends MVCComponent implements RouterServiceInterface,
	BootableExtensionInterface,
	CdekClientAwareInterface,
	CitiesUpdaterServiceAwareInterface,
	OfficesUpdaterServiceAwareInterface,
	OrderStatusUpdaterServiceAwareInterface,
	WebhookServiceAwareInterface
{
	use AssociationServiceTrait;
	use RouterServiceTrait;
	use HTMLRegistryAwareTrait;
	use CdekClientAwareTrait;
	use CitiesUpdaterServiceAwareTrait;
	use DatabaseAwareTrait;
	use OfficesUpdaterServiceAwareTrait;
	use OrderStatusUpdaterServiceAwareTrait;
	use WebhookServiceAwareTrait;

	/**
	 * Booting the extension. This is the function to set up the environment of the extension like
	 * registering new class loaders, etc.
	 *
	 * If required, some initial set-up can be done from services of the container, e.g.,
	 * registering HTML services.
	 *
	 * @param   ContainerInterface  $container  The container
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function boot(ContainerInterface $container): void
	{
		$this->getRegistry()->register('wishboxcdekadministrator', new AdministratorService());
	}
}
