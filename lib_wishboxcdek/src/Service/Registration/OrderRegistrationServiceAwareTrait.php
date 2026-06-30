<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\Registration;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for an OrderRegistrationService aware class.
 *
 * @since 1.0.0
 */
trait OrderRegistrationServiceAwareTrait
{
	/**
	 * @var OrderRegistrationService|null
	 *
	 * @since 1.0.0
	 */
	private ?OrderRegistrationService $orderRegistrationService = null;

	/**
	 * Get the order registration service.
	 *
	 * @return OrderRegistrationService
	 *
	 * @throws UnexpectedValueException
	 *
	 * @since 1.0.0
	 */
	protected function getOrderRegistrationService(): OrderRegistrationService
	{
		if ($this->orderRegistrationService)
		{
			return $this->orderRegistrationService;
		}

		throw new UnexpectedValueException('OrderRegistrationService not set in ' . __CLASS__);
	}

	/**
	 * Set the order registration service.
	 *
	 * @param   OrderRegistrationService  $orderRegistrationService  Order registration service
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function setOrderRegistrationService(OrderRegistrationService $orderRegistrationService): void
	{
		$this->orderRegistrationService = $orderRegistrationService;
	}
}
