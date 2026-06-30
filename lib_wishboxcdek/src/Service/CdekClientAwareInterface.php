<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Service;

use WishboxCdek\CdekClient;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a CDEK client.
 *
 * @since  1.0.0
 */
interface CdekClientAwareInterface
{
	/**
	 * Set the CDEK client to use.
	 *
	 * @param   CdekClient  $client  The CDEK client.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCdekClient(CdekClient $client): void;
}
