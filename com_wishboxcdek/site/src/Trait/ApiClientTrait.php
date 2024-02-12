<?php
/**
 * @copyright (c) 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Trait;

use AntistressStore\CdekSDK2\CdekClientV2;
use Joomla\CMS\Component\ComponentHelper;

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
