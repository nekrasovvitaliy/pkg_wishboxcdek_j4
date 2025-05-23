<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Event\Model\OrderStatusUpdater;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
abstract class UpdateEvent extends AbstractEvent
{
	/**
	 * Setter for the cdekNumbers argument.
	 *
	 * @param   string[]  $value  The value to set
	 *
	 * @return  string[]
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetCdekNumbers(array $value): array
	{
		return $value;
	}

	/**
	 * Setter for the component argument.
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
	protected function onSetComponent(string $value): string
	{
		return $value;
	}

	/**
	 * Setter for the orderIds argument.
	 *
	 * @param   integer[]  $value  The value to set
	 *
	 * @return  integer[]
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetOrderIds(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the cdekNumbers argument.
	 *
	 * @param   string[]  $value  Value
	 *
	 * @return  string[]
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetCdekNumbers(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the comment argument.
	 *
	 * @param   string  $value  Value
	 *
	 * @return  string
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetComponent(string $value): string
	{
		return $value;
	}

	/**
	 * Getter for the orderIds argument.
	 *
	 * @param   integer[]  $value  Value
	 *
	 * @return  integer[]
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetOrderIds(array $value): array
	{
		return $value;
	}

	/**
	 * @return string[]
	 *
	 * @since  1.0.0
	 */
	public function getCdekNumbers(): array
	{
		return $this->arguments['cdekNumbers'];
	}
}
