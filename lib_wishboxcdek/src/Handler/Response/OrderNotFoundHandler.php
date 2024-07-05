<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use Joomla\Http\Response as HttpResponse;
use WishboxCdekSDK2\Exception\Client\OrderNotFoundException;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGetResponse;

/**
 * @since 1.0.0
 */
class OrderNotFoundHandler extends AbstractResponseHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   string        $type          Type
	 * @param   HttpResponse  $httpResponse  HTTP response
	 *
	 * @return boolean
	 *
	 * @throws OrderNotFoundException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, string $type, HttpResponse $httpResponse): bool
	{
		$responseCode = $response->code;

		if ($responseCode == 400 && $type == OrdersGetResponse::class)
		{
			$responseBody = $response->body;
			$responseBodyObject = json_decode($responseBody);

			if ($responseBodyObject->ge)

			throw new V2EntityNotFoundImNumberException(
				$responseBodyObject->error_description, // phpcs:ignore
				$response->code
			);
		}

		return $this->next($path, $type, $response);
	}
}
