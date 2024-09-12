<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
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
	public function getOffices(int $cityCode, ?bool $allowedCod = null, ?array $packages = null): array;
}
