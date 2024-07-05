<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Exception;

use Exception;
use Joomla\CMS\Language\Text;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGetResponse;

/**
 * @since 1.0.0
 */
class OrderExistsException extends Exception
{
	/**
	 * @var OrdersGetResponse $ordersGetResponse Order response
	 *
	 * @since 1.0.0
	 */
	protected OrdersGetResponse $ordersGetResponse;

	/**
	 * @param   OrdersGetResponse  $ordersGetResponse  Uuid
	 *
	 * @since 1.0.0
	 */
	public function __construct(OrdersGetResponse $ordersGetResponse)
	{
		$this->ordersGetResponse = $ordersGetResponse;
		$message = Text::sprintf(
			'PLG_RADICALMART_SHIPPING_WISHBOXCDEK_MESSAGE_ORDER_EXISTS'
		);

		parent::__construct($message, 200);
	}

	/**
	 * @return OrdersGetResponse
	 *
	 * @since 1.0.0
	 */
	public function getOrdersGetResponse(): OrdersGetResponse
	{
		return $this->ordersGetResponse;
	}
}
