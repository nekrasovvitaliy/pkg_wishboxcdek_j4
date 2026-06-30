<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Event\Service\OrderStatusUpdater;

use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Event\Result\ResultAware;
use Joomla\CMS\Event\Result\ResultAwareInterface;
use Joomla\CMS\Event\Result\ResultTypeStringAware;
use WishboxCdekLibrary\Service\Order\OrderStatusUpdaterService;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class GetCdekNumbersEvent extends AbstractEvent implements ResultAwareInterface
{
	use ResultAware;
	use ResultTypeStringAware;

	/**
	 * @param   string  $eventName  Event name
	 * @param   array   $arguments  Arguments
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $eventName, array $arguments)
	{
		parent::__construct($eventName, $arguments);

		$this->preventSetArgumentResult = true;
	}

	/**
	 * @param   OrderStatusUpdaterService  $value  Subject
	 *
	 * @return OrderStatusUpdaterService
	 *
	 * @since 1.0.0
	 */
	protected function onSetSubject(OrderStatusUpdaterService $value): OrderStatusUpdaterService
	{
		return $value;
	}

	/**
	 * @param   string  $value  Component
	 *
	 * @return string
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetComponent(string $value): string
	{
		return $value;
	}

	/**
	 * @param   integer[]  $value  Order ids
	 *
	 * @return array
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetOrderIds(array $value): array
	{
		return $value;
	}

	/**
	 * @param   OrderStatusUpdaterService  $value  Subject
	 *
	 * @return OrderStatusUpdaterService
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetSubject(OrderStatusUpdaterService $value): OrderStatusUpdaterService
	{
		return $value;
	}

	/**
	 * @return OrderStatusUpdaterService
	 *
	 * @since 1.0.0
	 */
	public function getOrderStatusUpdaterService(): OrderStatusUpdaterService
	{
		return $this->getArgument('subject');
	}

	/**
	 * @return OrderStatusUpdaterService
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOrderStatusUpdaterModel(): OrderStatusUpdaterService
	{
		return $this->getOrderStatusUpdaterService();
	}

	/**
	 * @return string[]
	 *
	 * @since 1.0.0
	 */
	public function getCdekNumbers(): array
	{
		return $this->getArgument('result') ?? [];
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getComponent(): string
	{
		return $this->arguments['component'];
	}

	/**
	 * @return integer[]
	 *
	 * @since 1.0.0
	 */
	public function getOrderIds(): array
	{
		return $this->arguments['orderIds'];
	}
}
