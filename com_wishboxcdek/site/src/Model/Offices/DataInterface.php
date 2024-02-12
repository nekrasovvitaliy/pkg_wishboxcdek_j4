<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license   GNU General Public License version 2 or later
 */
namespace Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek\Offices;

//
defined('_JEXEC') or die;

/**
 *
 */
interface DataInterface
{
	public function getOffices(int $city_code, ?array $min_dimensions = null): array;
}