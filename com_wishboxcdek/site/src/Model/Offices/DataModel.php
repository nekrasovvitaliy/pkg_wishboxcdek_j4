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
abstract class DataModel extends \WishBox\JShopping\Model\Base
{
	/**
	 *
	 */
	protected string $addonAlias = 'wishboxcdek';


	/**
	*
	*/
	public function __construct($config = [], \MVCFactoryInterface $factory = null)
	{
		parent::__construct($config, $factory);
	}
}
