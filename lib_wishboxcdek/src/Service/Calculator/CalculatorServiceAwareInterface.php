<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WishboxCdekLibrary\Service\Calculator;

use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a calculator service.
 *
 * @since  1.0.0
 */
interface CalculatorServiceAwareInterface
{
	/**
	 * Set the calculator service.
	 *
	 * @param   CalculatorService  $calculatorService  The calculator service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCalculatorService(CalculatorService $calculatorService): void;
}
