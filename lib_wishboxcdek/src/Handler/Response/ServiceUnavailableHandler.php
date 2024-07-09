<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use WishboxCdekSDK2\Exception\ClientException;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * @since 1.0.0
 */
class ServiceUnavailableHandler extends AbstractResponseHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @throws ClientException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, ResponseData $responseData): bool
	{
		if ($responseData->getCode() >= 500)
		{
			$message = $responseData->getBody();

			if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $message, $matches))
			{
				$message = strip_tags($matches[1]);
			}

			$message = strip_tags($message);

			throw new ClientException($message, $responseData->getCode());
		}

		return $this->next($path, $responseData);
	}
}
