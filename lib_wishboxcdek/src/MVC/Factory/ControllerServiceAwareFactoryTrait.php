<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\MVC\Factory;

use WishboxCdekLibrary\Service\City\CitiesUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\City\CitiesUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterServiceAwareTrait;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareInterface;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Injects library services into aware controllers created by MVC factories.
 *
 * @since  1.0.0
 */
trait ControllerServiceAwareFactoryTrait
{
	use CitiesUpdaterServiceAwareTrait;
	use OfficesUpdaterServiceAwareTrait;
	use OrderStatusUpdaterServiceAwareTrait;
	use WebhookServiceAwareTrait;

	/**
	 * Set services on aware controllers.
	 *
	 * @param   object|null  $controller  Controller instance
	 *
	 * @return  object|null
	 *
	 * @since   1.0.0
	 */
	protected function setControllerServices(?object $controller): ?object
	{
		if ($controller instanceof CitiesUpdaterServiceAwareInterface)
		{
			$controller->setCitiesUpdaterService($this->getCitiesUpdaterService());
		}

		if ($controller instanceof OfficesUpdaterServiceAwareInterface)
		{
			$controller->setOfficesUpdaterService($this->getOfficesUpdaterService());
		}

		if ($controller instanceof OrderStatusUpdaterServiceAwareInterface)
		{
			$controller->setOrderStatusUpdaterService($this->getOrderStatusUpdaterService());
		}

		if ($controller instanceof WebhookServiceAwareInterface)
		{
			$controller->setWebhookService($this->getWebhookService());
		}

		return $controller;
	}
}
