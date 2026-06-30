<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseModel;
use WishboxCdek\CdekClient;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterService;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OrderStatusUpdaterModel extends BaseModel
{
	/**
	 * @param   string     $component  Component
	 * @param   integer[]  $orderIds   Order ids
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(string $component = '', array $orderIds = []): void
	{
		$this->getOrderStatusUpdaterService()->update($component, $orderIds);
	}

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function updateAll(): void
	{
		$this->update();
	}

	/**
	 * @return OrderStatusUpdaterService
	 *
	 * @since 1.0.0
	 */
	private function getOrderStatusUpdaterService(): OrderStatusUpdaterService
	{
		$container = Factory::getContainer();

		if ($container->has(OrderStatusUpdaterService::class))
		{
			return $container->get(OrderStatusUpdaterService::class);
		}

		return new OrderStatusUpdaterService($container->get(CdekClient::class));
	}
}
