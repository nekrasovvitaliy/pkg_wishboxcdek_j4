<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Factory;

use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a request factory.
 *
 * @since  1.0.0
 */
interface RequestFactoryAwareInterface
{
	/**
	 * Set the request factory to use.
	 *
	 * @param   RequestFactoryInterface  $factory  The request factory to use.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setRequestFactory(RequestFactoryInterface $factory): void;
}
