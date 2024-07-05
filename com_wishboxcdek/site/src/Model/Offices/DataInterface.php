<?php
/**
 * @copyright  2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
interface DataInterface
{
	/**
	 * @param   integer     $cityCode         City code
	 * @param   array|null  $orderDimensions  Order dimensions
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?array $orderDimensions = null): array;
}
