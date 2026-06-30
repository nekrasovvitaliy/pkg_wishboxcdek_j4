<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\Service\Calculator;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a CalculatorService aware class.
 *
 * @since  1.0.0
 */
trait CalculatorServiceAwareTrait
{
	/**
	 * The calculator service.
	 *
	 * @var    CalculatorService|null
	 *
	 * @since  1.0.0
	 */
	private ?CalculatorService $calculatorService = null;

	/**
	 * Get the calculator service.
	 *
	 * @return  CalculatorService
	 *
	 * @throws  UnexpectedValueException  May be thrown if the CalculatorService has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getCalculatorService(): CalculatorService
	{
		if ($this->calculatorService)
		{
			return $this->calculatorService;
		}

		throw new UnexpectedValueException('CalculatorService not set in ' . __CLASS__);
	}

	/**
	 * Set the calculator service to use.
	 *
	 * @param   CalculatorService  $calculatorService  The calculator service.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setCalculatorService(CalculatorService $calculatorService): void
	{
		$this->calculatorService = $calculatorService;
	}
}
