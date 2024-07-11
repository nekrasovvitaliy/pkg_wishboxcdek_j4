<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Trait;

use Exception;
use Joomla\CMS\Factory;
use Joomla\Component\Wishboxcdek\Administrator\Extension\WishboxcdekComponent;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
trait ComponentTrait
{
	/**
	 * Method to get calendar data array.
	 *
	 * @return  WishboxcdekComponent
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function getComponent(): WishboxcdekComponent
	{
		$app = Factory::getApplication();

		/** @var WishboxcdekComponent $component */
		$component = $app->bootComponent('com_wishboxcdek');

		return $component;
	}
}
