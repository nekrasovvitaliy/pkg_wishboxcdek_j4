<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Service;

use UnexpectedValueException;
use WishboxCdek\CdekClient;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a CdekClient aware class.
 *
 * @since  1.0.0
 */
trait CdekClientAwareTrait
{
	/**
	 * The CDEK client.
	 *
	 * @var    CdekClient|null
	 *
	 * @since  1.0.0
	 */
	private ?CdekClient $cdekClient = null;

	/**
	 * Get the CDEK client.
	 *
	 * @return  CdekClient
	 *
	 * @throws  UnexpectedValueException  May be thrown if the CDEK client has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getCdekClient(): CdekClient
	{
		if ($this->cdekClient)
		{
			return $this->cdekClient;
		}

		throw new UnexpectedValueException('CdekClient not set in ' . __CLASS__);
	}

	/**
	 * Set the CDEK client to use.
	 *
	 * @param   CdekClient  $client  The CDEK client.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCdekClient(CdekClient $client): void
	{
		$this->cdekClient = $client;
	}
}
