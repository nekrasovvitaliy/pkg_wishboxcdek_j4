<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response;
use WishboxCdekSDK2\ApiClientException;

/**
 * @since 1.0.0
 */
class InvalidClientHandler extends AbstractResponseHandler
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
		$responseCode = $response->code;

		if ($responseCode == 401)
		{
			$responseBody = $response->body;

			if (!empty($responseBody))
			{
				$responseBody = json_decode($responseBody);

				if ($responseBody->error == 'invalid_client')
				{
					throw new ApiClientException($responseBody->error_description, $response->code); // phpcs:ignore
				}
			}
		}

		return $this->next($path, $type, $response);
	}
}
