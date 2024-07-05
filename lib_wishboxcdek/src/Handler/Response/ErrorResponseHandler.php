<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response as HttpResponse;
use WishboxCdekSDK2\ApiClientException;
use WishboxCdekSDK2\Factory\ApiExceptionFactory;

/**
 * Class ErrorResponseHandler
 *
 * @since 1.0.0
 */
class ErrorResponseHandler extends AbstractResponseHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   string        $type          Type
	 * @param   HttpResponse  $httpResponse  HTTP response
	 *
	 * @return boolean
	 *
	 * @throws ApiClientException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, string $type, HttpResponse $httpResponse): bool
	{
		$responseCode = $httpResponse->code;

		if ($responseCode >= 400 && $responseCode < 500)
		{
			$responseBody = $httpResponse->body;

			ApiExceptionFactory::createException(
				$httpResponse->code
			);
			throw new ApiClientException($responseBody, $httpResponse->code);
		}

		return $this->next($path, $type, $httpResponse);
	}
}
