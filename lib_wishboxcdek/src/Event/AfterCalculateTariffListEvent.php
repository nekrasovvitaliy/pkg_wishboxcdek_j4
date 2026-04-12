<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace WishboxCdekSDK2\Event;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPostRequest;
use WishboxCdekSDK2\Model\Response\Calculator\TariffListPostResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class AfterCalculateTariffListEvent extends AbstractEvent
{
	/**
	 * Setter for the request argument.
	 *
	 * @param   TariffListPostRequest  $value  The value to set
	 *
	 * @return  TariffListPostRequest
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetRequest(TariffListPostRequest $value): TariffListPostRequest
	{
		return $value;
	}

	/**
	 * Setter for the responce argument.
	 *
	 * @param   TariffListPostResponse  $value  The value to set
	 *
	 * @return  TariffListPostResponse
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetResponce(TariffListPostResponse $value): TariffListPostResponse
	{
		return $value;
	}

	/**
	 * Getter for the request argument.
	 *
	 * @param   TariffListPostRequest  $value  Value
	 *
	 * @return  TariffListPostRequest
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetRequest(TariffListPostRequest $value): TariffListPostRequest
	{
		return $value;
	}

	/**
	 * Getter for the response argument.
	 *
	 * @param   TariffListPostResponse  $value  Value
	 *
	 * @return  TariffListPostResponse
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetResponse(TariffListPostResponse $value): TariffListPostResponse
	{
		return $value;
	}

	/**
	 * @return  CdekClientV2
	 *
	 * @since  1.0.0
	 */
	public function getApiClient(): CdekClientV2
	{
		return $this->getArgument('subject');
	}

	/**
	 * @return  TariffListPostRequest
	 *
	 * @since  1.0.0
	 */
	public function getRequest(): TariffListPostRequest
	{
		return $this->getArgument('request');
	}

	/**
	 * @return TariffListPostResponse
	 *
	 * @since  1.0.0
	 */
	public function getResponse(): TariffListPostResponse
	{
		return $this->getArgument('response');
	}
}
