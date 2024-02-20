<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Helper;

use Exception;
use Joomla\CMS\Factory;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Wishboxcdek Helper Class
 *
 * @since  1.0.0
 */
abstract class WishboxcdekHelper
{
	/**
	 * @param   string  $tariffCode  Tariff code
	 *
	 * @return boolean
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public static function isTariffToPoint(string $tariffCode): bool
	{
		$tariffTable = Factory::getApplication()
			->bootComponent('com_wishboxcdek')
			->getMVCFactory()
			->createTable('Tariff', 'Administrator');
		$tariffTable->load(['code' => $tariffCode]);

		list(, $deliveryTariffMode) = explode('-', $tariffTable->mode);

		if ($deliveryTariffMode == 'С')
		{
			return true;
		}

		return false;
	}
}
