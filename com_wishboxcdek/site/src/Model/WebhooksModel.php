<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Model\Request\Webhooks\WebhooksGetRequest;
use WishboxCdekSDK2\Model\Request\Webhooks\WebhooksPostRequest;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class WebhooksModel extends \Joomla\CMS\MVC\Model\BaseModel
{
	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(): void
	{
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');
		$gerWebhooksRequest = new WebhooksGetRequest;
		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);
		$getWebhookResponses = $apiClient->getWebhooks($gerWebhooksRequest);

		$flag = false;

		$webhookUrl = '';

		foreach ($getWebhookResponses as $webhookResponse)
		{
			$type = $webhookResponse->getType();
			$url = $webhookResponse->getUrl();

			if ($type == 'ORDER_STATUS' && $url == $webhookUrl)
			{
				$flag = true;
			}
		}

		if (!$flag)
		{
			$postWebhooksRequest = (new WebhooksPostRequest)
				->setType('ORDER_STATUS')
				->setUrl($webhookUrl);
			$apiClient->createWebhook($postWebhooksRequest);
		}
	}
}
