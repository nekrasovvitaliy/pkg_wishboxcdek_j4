<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\Office;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for an OfficesUpdaterService aware class.
 *
 * @since  1.0.0
 */
trait OfficesUpdaterServiceAwareTrait
{
	/**
	 * The offices updater service.
	 *
	 * @var    OfficesUpdaterService|null
	 *
	 * @since  1.0.0
	 */
	private ?OfficesUpdaterService $officesUpdaterService = null;

	/**
	 * Get the offices updater service.
	 *
	 * @return  OfficesUpdaterService
	 *
	 * @throws  UnexpectedValueException  May be thrown if the OfficesUpdaterService has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getOfficesUpdaterService(): OfficesUpdaterService
	{
		if ($this->officesUpdaterService)
		{
			return $this->officesUpdaterService;
		}

		throw new UnexpectedValueException('OfficesUpdaterService not set in ' . __CLASS__);
	}

	/**
	 * Set the offices updater service to use.
	 *
	 * @param   OfficesUpdaterService  $officesUpdaterService  The offices updater service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setOfficesUpdaterService(OfficesUpdaterService $officesUpdaterService): void
	{
		$this->officesUpdaterService = $officesUpdaterService;
	}
}
