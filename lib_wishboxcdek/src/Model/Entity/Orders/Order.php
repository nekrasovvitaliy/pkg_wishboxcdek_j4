<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Responses;

use WishboxCdekSDK2\Traits\AdditionalOrderTypesOptionalTrait;
use WishboxCdekSDK2\Traits\CdekNumberOptionalTrait;
use WishboxCdekSDK2\Traits\Order\CallsOptionalTrait;
use WishboxCdekSDK2\Traits\Order\CommentOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DateInvoiceOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryDetailOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryModeOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryPointOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryProblemOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryRecipientCostAdvOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeliveryRecipientCostOptionalTrait;
use WishboxCdekSDK2\Traits\Order\DeveloperKeyOptionalTrait;
use WishboxCdekSDK2\Traits\Order\FromLocationTrait;
use WishboxCdekSDK2\Traits\Order\IsClientReturnTrait;
use WishboxCdekSDK2\Traits\Order\IsReturnTrait;
use WishboxCdekSDK2\Traits\Order\IsReverseTrait;
use WishboxCdekSDK2\Traits\Order\KeepFreeUntilOptionalt;
use WishboxCdekSDK2\Traits\Order\NumberOptionalTrait;
use WishboxCdekSDK2\Traits\Order\PackagesOptionalTrait;
use WishboxCdekSDK2\Traits\Order\PlannedDeliveryDateOptionalTrait;
use WishboxCdekSDK2\Traits\Order\RecipientTrait;
use WishboxCdekSDK2\Traits\Order\SellerOptionalTrait;
use WishboxCdekSDK2\Traits\Order\SenderTrait;
use WishboxCdekSDK2\Traits\Order\ServicesOptionalTrait;
use WishboxCdekSDK2\Traits\Order\ShipmentPointOptionalTrait;
use WishboxCdekSDK2\Traits\Order\ShipperAddressOptionalTrait;
use WishboxCdekSDK2\Traits\Order\ShipperNameOptionalTrait;
use WishboxCdekSDK2\Traits\Order\ToLocationTrait;
use WishboxCdekSDK2\Traits\Order\TransactedPaymentOptionalTrait;
use WishboxCdekSDK2\Traits\Order\UuidTrait;
use WishboxCdekSDK2\Traits\TariffCodeTrait;
use WishboxCdekSDK2\Traits\TypeTrait;

/**
 * Class Orders.
 *
 * @since 1.0.0
 */
class Order extends Source
{
	use UuidTrait,
		IsReturnTrait,
		IsReverseTrait,
		IsClientReturnTrait,
		TypeTrait,
		AdditionalOrderTypesOptionalTrait,
		CdekNumberOptionalTrait,
		NumberOptionalTrait,
		DeliveryModeOptionalTrait,
		TariffCodeTrait,
		CommentOptionalTrait,
		DeveloperKeyOptionalTrait,
		ShipmentPointOptionalTrait,
		DeliveryPointOptionalTrait,
		DateInvoiceOptionalTrait,
		ShipperNameOptionalTrait,
		ShipperAddressOptionalTrait,
		DeliveryRecipientCostOptionalTrait,
		DeliveryRecipientCostAdvOptionalTrait,
		SenderTrait,
		SellerOptionalTrait,
		RecipientTrait,
		FromLocationTrait,
		ToLocationTrait,
		ServicesOptionalTrait,
		PackagesOptionalTrait,
		DeliveryProblemOptionalTrait,
		DeliveryDetailOptionalTrait,
		TransactedPaymentOptionalTrait,
		CallsOptionalTrait,
		PlannedDeliveryDateOptionalTrait,
		KeepFreeUntilOptionalt;

	/**
	 * Связанные с заказом сущности.
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected array $related_entities; // phpcs:ignore

	/**
	 * Информация о запросе/запросах над заказом.
	 *
	 * @var RequestsResponse[]
	 *
	 * @since 1.0.0
	 */
	protected array $requests;

	/**
	 * @param   array|null  $properties  Properties
	 *
	 * @since 1.0.0
	 */
	public function __construct(?array $properties = null)
	{
		if (isset($properties['related_entities']))
		{
			$this->related_entities = $properties['related_entities']; // phpcs:ignore
		}

		parent::__construct($properties);
	}

	/**
	 * Получить значение - связанные с заказом сущности.
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getRelatedEntities(): array
	{
		return $this->related_entities; // phpcs:ignore
	}

	/**
	 * Получить последнюю (самую новую) связанную сущность.
	 *
	 * @param   string  $type  Type
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getLastRelated($type)
	{
		$newest = [];

		if (is_array($this->related_entities)) // phpcs:ignore
		{
			foreach ($this->related_entities as $value) // phpcs:ignore
			{
				if (isset($value['type']) && $value['type'] == $type)
				{
					$newest[] = $value;
				}
				else
				{
					continue;
				}
			}
		}

		return (!empty($newest)) ? end($newest)['uuid'] : null;
	}

	/**
	 * Получить значение - информация о запросе/запросах над заказом.
	 *
	 * @return RequestsResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getRequests(): array
	{
		return $this->requests;
	}
}
