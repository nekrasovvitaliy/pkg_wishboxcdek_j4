<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Service\City;

use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a cities updater service.
 *
 * @since  1.0.0
 */
interface CitiesUpdaterServiceAwareInterface
{
	/**
	 * Set the cities updater service.
	 *
	 * @param   CitiesUpdaterService  $citiesUpdaterService  The cities updater service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCitiesUpdaterService(CitiesUpdaterService $citiesUpdaterService): void;
}
