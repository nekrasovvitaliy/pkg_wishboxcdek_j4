<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response;
use WishboxCdekSDK2\ApiClientException;

/**
 * Class AccountNotFoundHandler
 *
 * @since 1.0.0
 */
class AccountNotFoundHandler extends AbstractResponseHandler
{
	/**
	 * @param   string    $path      Path
	 * @param   Response  $response  Response
	 *
	 * @return boolean
	 *
	 * @throws ApiClientException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, Response $response): bool
	{
		if ($response->code >= 400 && $response->body == 'No valid key specified')
		{
			$responseBody = $response->body;
			print_r($responseBody);
			throw new ApiClientException($response->body, $response->code);
		}

		return $this->next($path, $response);
	}
}
