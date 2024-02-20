<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Plugin\RadicalMartShipping\Wishboxcdek\Exception;

use AntistressStore\CdekSDK2\Entity\Responses\OrderResponse;
use Exception;
use Joomla\CMS\Language\Text;

/**
 * @since 1.0.0
 */
class OrderExistsException extends Exception
{
	/**
	 * @var OrderResponse $orderResponse Order response
	 *
	 * @since 1.0.0
	 */
	protected OrderResponse $orderResponse;

	/**
	 * @param   OrderResponse  $orderResponse  Uuid
	 *
	 * @since 1.0.0
	 */
	public function __construct(OrderResponse $orderResponse)
	{
		$this->orderResponse = $orderResponse;
		$message = Text::sprintf(
			'PLG_RADICALMART_SHIPPING_WISHBOXCDEK_MESSAGE_ORDER_EXISTS'
		);

		parent::__construct($message, 200);
	}

	/**
	 * @return OrderResponse
	 *
	 * @since 1.0.0
	 */
	public function getOrderResponse(): OrderResponse
	{
		return $this->orderResponse;
	}
}
