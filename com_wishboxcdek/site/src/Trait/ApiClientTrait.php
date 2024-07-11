<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Trait;

use Joomla\CMS\Component\ComponentHelper;
use WishboxCdekSDK2\CdekClientV2;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
trait ApiClientTrait
{
	/**
	 * @return CdekClientV2
	 *
	 * @since 1.0.0
	 */
	protected function getApiClient(): CdekClientV2
	{
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		return new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);
	}
}
