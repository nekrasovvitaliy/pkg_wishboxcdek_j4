<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\StatusResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class UpdateOrderStatusEvent extends AbstractEvent
{
	/**
	 * Setter for the cdekNumber argument.
	 *
	 * @param   string  $value  The value to set
	 *
	 * @return  string
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetCdekNumber(string $value): string
	{
		if (empty($value))
		{
			throw new Exception('Value must be not empty');
		}

		return $value;
	}

	/**
	 * Setter for the orderCdekStatuses argument.
	 *
	 * @param   StatusResponse[]  $value  The value to set
	 *
	 * @return  StatusResponse[]
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetOrderCdekStatuses(array $value): array
	{
		if (!count($value))
		{
			throw new Exception('Value must be not empty array');
		}

		return $value;
	}

	/**
	 * Getter for the cdekNumber argument.
	 *
	 * @param   string  $value  Value
	 *
	 * @return  string
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetCdekNumber(string $value): string
	{
		return $value;
	}

	/**
	 * Getter for the orderCdekStatuses argument.
	 *
	 * @param   StatusResponse[]  $value  Value
	 *
	 * @return  array
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetOrderCdekStatuses(array $value): array
	{
		return $value;
	}

	/**
	 * @return  string
	 *
	 * @since  1.0.0
	 */
	public function getCdekNumber(): string
	{
		return $this->getArgument('cdekNumber');
	}

	/**
	 * @return StatusResponse[]
	 *
	 * @since  1.0.0
	 */
	public function getOrderCdekStatuses(): array
	{
		return $this->getArgument('orderCdekStatuses');
	}
}
