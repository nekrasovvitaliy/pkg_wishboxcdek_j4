<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Entity\Responses\Source;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\AddressOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\CityTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\CodeTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\CountryCodeTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\FiasGuidOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\LatitudeOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\LongitudeOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\PostalCodeOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\RegionCodeOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\RegionOptionalTrait;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait\SubRegionOptionalTrait;

/**
 * @since 1.0.0
 */
class LocationResponse extends Source
{
	use CodeTrait,
		FiasGuidOptionalTrait,
		PostalCodeOptionalTrait,
		LongitudeOptionalTrait,
		LatitudeOptionalTrait,
		CountryCodeTrait,
		RegionOptionalTrait,
		RegionCodeOptionalTrait,
		SubRegionOptionalTrait,
		CityTrait,
		AddressOptionalTrait;
}
