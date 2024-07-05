<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet;

use WishboxCdekSDK2\Entity\Requests\Source;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\AdditionalOrderTypesOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\CdekNumberOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\CallsOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\CommentOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DateInvoiceOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryDetailOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryModeOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryPointOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryProblemOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryRecipientCostAdvOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeliveryRecipientCostOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\DeveloperKeyOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\FromLocationTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\IsClientReturnTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\IsReturnTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\IsReverseTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\KeepFreeUntilOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\NumberOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\PackagesOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\PlannedDeliveryDateOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\RecipientTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\SellerOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\SenderTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\ServicesOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\ShipmentPointOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\ShipperAddressOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\ShipperNameOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\ToLocationTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\TransactedPaymentOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait\UuidTrait;
use WishboxCdekSDK2\Traits\TariffCodeTrait;
use WishboxCdekSDK2\Traits\TypeTrait;

/**
 * Class Orders.
 *
 * @since 1.0.0
 */
class Entity extends Source
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
		KeepFreeUntilOptionalTrait;
}
