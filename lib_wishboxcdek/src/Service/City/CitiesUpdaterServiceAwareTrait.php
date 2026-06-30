<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\City;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a CitiesUpdaterService aware class.
 *
 * @since  1.0.0
 */
trait CitiesUpdaterServiceAwareTrait
{
	/**
	 * The cities updater service.
	 *
	 * @var    CitiesUpdaterService|null
	 *
	 * @since  1.0.0
	 */
	private ?CitiesUpdaterService $citiesUpdaterService = null;

	/**
	 * Get the cities updater service.
	 *
	 * @return  CitiesUpdaterService
	 *
	 * @throws  UnexpectedValueException  May be thrown if the CitiesUpdaterService has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getCitiesUpdaterService(): CitiesUpdaterService
	{
		if ($this->citiesUpdaterService)
		{
			return $this->citiesUpdaterService;
		}

		throw new UnexpectedValueException('CitiesUpdaterService not set in ' . __CLASS__);
	}

	/**
	 * Set the cities updater service to use.
	 *
	 * @param   CitiesUpdaterService  $citiesUpdaterService  The cities updater service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCitiesUpdaterService(CitiesUpdaterService $citiesUpdaterService): void
	{
		$this->citiesUpdaterService = $citiesUpdaterService;
	}
}
