<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use WishboxCdekSDK2\Factory\ApiExceptionFactory;
use WishboxCdekSDK2\Interface\ApiExceptionInterface;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * @since 1.0.0
 */
class ResponseErrorsHandler extends AbstractResponseHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @throws ApiExceptionInterface
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	protected function handleResponse(string $path, ResponseData $responseData): bool
	{
		if ($responseData->getCode() >= 400 && $responseData->getCode() < 500)
		{
			$responseBodyData = json_decode($responseData->getBody());

			if (is_object($responseBodyData) && isset($responseBodyData->errors)
				&& is_array($responseBodyData->errors) && count($responseBodyData->errors))
			{
				foreach ($responseBodyData->errors as $error)
				{
					$e = ApiExceptionFactory::createErrorsException(
						$error->code,
						$responseData
					);
					throw $e;
				}
			}
		}

		return $this->next($path, $responseData);
	}
}
