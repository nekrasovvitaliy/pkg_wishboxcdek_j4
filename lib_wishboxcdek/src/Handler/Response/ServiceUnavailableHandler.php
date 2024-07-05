<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response;
use WishboxCdekSDK2\ApiClientException;

/**
 * @since 1.0.0
 */
class ServiceUnavailableHandler extends AbstractResponseHandler
{
	/**
	 * @param   string    $path      Path
	 * @param   string    $type      Type
	 * @param   Response  $response  Response
	 *
	 * @return boolean
	 *
	 * @throws ApiClientException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, string $type, Response $response): bool
	{
		if ($response->code >= 500)
		{
			$message = $response->body;

			if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $message, $matches))
			{
				$message = strip_tags($matches[1]);
			}

			$message = strip_tags($message);

			throw new ApiClientException($message, $response->code);
		}

		return $this->next($path, $type, $response);
	}
}
