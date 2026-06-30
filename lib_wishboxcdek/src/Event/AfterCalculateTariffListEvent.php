<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Event;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdek\CdekClient;
use WishboxCdek\Request\Calculator\CalculateTariffListRequest;
use WishboxCdek\Response\Calculator\CalculateTariffListResponse;
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
	 * @param   CalculateTariffListRequest  $value  The value to set
	 *
	 * @return  CalculateTariffListRequest
	 *
	 * @throws Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetRequest(CalculateTariffListRequest $value): CalculateTariffListRequest
	{
		return $value;
	}

	/**
	 * Setter for the responce argument.
	 *
	 * @param   CalculateTariffListResponse  $value  The value to set
	 *
	 * @return  CalculateTariffListResponse
	 *
	 * @throws Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetResponce(CalculateTariffListResponse $value): CalculateTariffListResponse
	{
		return $value;
	}

	/**
	 * Getter for the request argument.
	 *
	 * @param   CalculateTariffListRequest  $value  Value
	 *
	 * @return  CalculateTariffListRequest
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetRequest(CalculateTariffListRequest $value): CalculateTariffListRequest
	{
		return $value;
	}

	/**
	 * Getter for the response argument.
	 *
	 * @param   CalculateTariffListResponse  $value  Value
	 *
	 * @return  CalculateTariffListResponse
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetResponse(CalculateTariffListResponse $value): CalculateTariffListResponse
	{
		return $value;
	}

	/**
	 * @return  CdekClient
	 *
	 * @since  1.0.0
	 */
	public function getApiClient(): CdekClient
	{
		return $this->getArgument('subject');
	}

	/**
	 * @return  CalculateTariffListRequest
	 *
	 * @since  1.0.0
	 */
	public function getRequest(): CalculateTariffListRequest
	{
		return $this->getArgument('request');
	}

	/**
	 * @return CalculateTariffListResponse
	 *
	 * @since  1.0.0
	 */
	public function getResponse(): CalculateTariffListResponse
	{
		return $this->getArgument('response');
	}
}
