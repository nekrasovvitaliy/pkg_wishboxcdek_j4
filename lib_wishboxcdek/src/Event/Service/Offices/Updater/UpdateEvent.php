<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Event\Service\Offices\Updater;

use Joomla\CMS\Event\AbstractEvent;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class UpdateEvent extends AbstractEvent
{
	/**
	 * Setter for the countryCodes argument.
	 *
	 * @param   string[]  $value  The value to set
	 *
	 * @return  array
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetCountryCodes(array $value): array
	{
		return $value;
	}

	/**
	 * Setter for the limit argument.
	 *
	 * @param   integer  $value  The value to set
	 *
	 * @return  integer
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * Getter for the countryCodes argument.
	 *
	 * @param   string[]  $value  Value
	 *
	 * @return  string[]
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetCountryCodes(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the limit argument.
	 *
	 * @param   integer  $value  Value
	 *
	 * @return  integer
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * @return  string[]
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCountryCodes(): array
	{
		return $this->getArgument('countryCodes');
	}

	/**
	 * @return integer
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLimit(): int
	{
		return $this->getArgument('limit');
	}
}
