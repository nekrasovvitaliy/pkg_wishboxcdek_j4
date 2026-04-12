<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use Joomla\CMS\Cache\CacheControllerFactoryAwareTrait;
use Joomla\CMS\Component\ComponentHelper;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\CdekClientV2Interface;

/**
 * @since 1.0.0
 */
class CdekClientV2Factory implements CdekClientV2FactoryInterface
{
	use CacheControllerFactoryAwareTrait;

	/**
	 * Creates client
	 *
	 * @return CdekClientV2
	 *
	 * @since 1.0.0
	 */
	public function getDefaultClient(): CdekClientV2Interface
	{
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		$client = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$client->setCacheControllerFactory($this->getCacheControllerFactory());

		return $client;
	}
}
