<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
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
	 * @param   integer       $cityCode    City code
	 * @param   boolean|null  $allowedCod  Allowed cod
	 * @param   string        $type        Type
	 * @param   array|null    $packages    Packages
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getOffices(int $cityCode, ?bool $allowedCod = null, string $type = 'ALL', ?array $packages = null): array;
}
