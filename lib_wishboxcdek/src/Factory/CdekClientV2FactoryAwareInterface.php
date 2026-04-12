<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a form factory.
 *
 * @since  1.0.0
 */
interface CdekClientV2FactoryAwareInterface
{
	/**
	 * Set the form factory to use.
	 *
	 * @param   CdekClientV2Factory  $cdekClientV2Factory  The API client factory to use.
	 *
	 * @return  CdekClientV2FactoryAwareInterface  This method is chainable.
	 *
	 * @since   1.0.0
	 */
	public function setCdekClientV2Factory(CdekClientV2FactoryInterface $cdekClientV2Factory): CdekClientV2FactoryAwareInterface;

	/**
	 * Get the form factory to use.
	 *
	 * @return  CdekClientV2FactoryAwareInterface
	 *
	 * @since   1.0.0
	 */
	public function getCdekClientV2Factory(): CdekClientV2FactoryInterface;
}
