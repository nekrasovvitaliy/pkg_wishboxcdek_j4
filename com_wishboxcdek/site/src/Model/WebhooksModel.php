<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Site\Model;

use Exception;
use WishboxCdekLibrary\Factory\CdekClientV2FactoryAwareInterface;
use WishboxCdekLibrary\Factory\CdekClientV2FactoryAwareTrait;
use WishboxCdekLibrary\Model\Request\Webhooks\WebhooksGetRequest;
use WishboxCdekLibrary\Model\Request\Webhooks\WebhooksPostRequest;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class WebhooksModel extends \Joomla\CMS\MVC\Model\BaseModel implements CdekClientV2FactoryAwareInterface
{
	use CdekClientV2FactoryAwareTrait;

	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(): void
	{
		$getWebhooksRequest = new WebhooksGetRequest;
		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();
		$webhookResponses = $apiClient->getWebhooks($getWebhooksRequest);

		$flag = false;

		$webhookUrl = 'https://radical-mart.ru/test.php';

		foreach ($webhookResponses as $webhookResponse)
		{
			//$uuid = $webhookResponse->getUuid();

			//$deleteWebhooksRequest = (new WebhooksDelRequest)->setUuid($uuid);

			//$apiClient->deleteWebhook($deleteWebhooksRequest);

			$type = $webhookResponse->getType();
			$url = $webhookResponse->getUrl();

			if ($type == 'ORDER_MODIFIED' && $url == $webhookUrl)
			{
				$flag = true;

				break;
			}
		}

		if (!$flag)
		{
			$postWebhooksRequest = (new WebhooksPostRequest)
				->setType('ORDER_MODIFIED')
				->setUrl($webhookUrl);
			$postWebhooksResponse = $apiClient->createWebhook($postWebhooksRequest);
		}

		$flag = false;

		$webhookUrl = 'https://radical-mart.ru/test.php';

		foreach ($webhookResponses as $webhookResponse)
		{
			$type = $webhookResponse->getType();
			$url = $webhookResponse->getUrl();

			if ($type == 'ORDER_STATUS' && $url == $webhookUrl)
			{
				$flag = true;

				break;
			}
		}

		if (!$flag)
		{
			$postWebhooksRequest = (new WebhooksPostRequest)
				->setType('ORDER_STATUS')
				->setUrl($webhookUrl);
			$postWebhooksResponse = $apiClient->createWebhook($postWebhooksRequest);
		}
	}
}
