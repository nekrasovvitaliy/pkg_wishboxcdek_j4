<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Handler\Response;

use WishboxCdekSDK2\Exception\Api\Error\NoValidKeySpecifiedException;
use WishboxCdekSDK2\Exception\ApiException;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * Class AccountNotFoundHandler
 *
 * @since 1.0.0
 */
class AccountNotFoundHandler extends AbstractResponseHandler
{
	/**
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response data
	 *
	 * @return boolean
	 *
	 * @throws ApiException
	 *
	 * @since 1.0.0
	 */
	protected function handleResponse(string $path, ResponseData $responseData): bool
	{
		if ($responseData->getCode() >= 400 && $responseData->getBody() == 'No valid key specified')
		{
			throw new NoValidKeySpecifiedException($responseData);
		}

		return $this->next($path, $responseData);
	}
}
