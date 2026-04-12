<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Site\Trait;

use Exception;
use Joomla\CMS\Factory;
use Joomla\Component\WishboxCdek\Administrator\Extension\WishboxCdekComponent;

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
	 * @return  WishboxCdekComponent
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function getComponent(): WishboxCdekComponent
	{
		$app = Factory::getApplication();

		/** @var WishboxCdekComponent $component */
		$component = $app->bootComponent('com_wishboxcdek');

		return $component;
	}
}
