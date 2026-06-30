<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Service\Office;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Event\DispatcherAwareInterface;
use Joomla\Event\DispatcherAwareTrait;
use Joomla\Event\DispatcherInterface;
use WishboxCdekLibrary\Event\Service\Offices\Updater\AfterLoadEvent;
use WishboxCdekLibrary\Event\Service\Offices\Updater\AfterUpdateEvent;
use WishboxCdekLibrary\Event\Service\Offices\Updater\BeforeLoadEvent;
use WishboxCdekLibrary\Event\Service\Offices\Updater\BeforeUpdateEvent;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\DatabaseInterface;
use ReflectionException;
use WishboxCdek\CdekClient;
use WishboxCdek\Enum\DeliveryPointType;
use WishboxCdek\Request\DeliveryPoint\GetDeliveryPointsRequest;
use WishboxCdek\Response\DeliveryPoint\DeliveryPointListResponse;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

// phpcs:disable PSR1.Files.SideEffects
require_once JPATH_SITE . '/vendor/autoload.php';
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
class OfficesUpdaterService implements CdekClientAwareInterface, DatabaseAwareInterface, DispatcherAwareInterface
{
	use CdekClientAwareTrait;
	use DatabaseAwareTrait;
	use DispatcherAwareTrait;

	/**
	 * Class constructor.
	 *
	 * @param   DatabaseInterface  $db          Database driver
	 * @param   CdekClient         $cdekClient  CDEK client
	 *
	 * @since 1.0.0
	 */
	public function __construct(DatabaseInterface $db, CdekClient $cdekClient, DispatcherInterface $dispatcher)
	{
		$this->setCdekClient($cdekClient);
		$this->setDispatcher($dispatcher);
		$this->setDatabase($db);
	}

	/**
	 * @param   integer  $limit  Limit
	 *
	 * @return boolean
	 *
	 * @throws ReflectionException
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(int $limit = 5000): bool
	{
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');
		$countryCodes    = $componentParams->get('country_codes', []);

		if (!count($countryCodes))
		{
			$countryCodes = [
				'AM',
				'BY',
				'KZ',
				'KG',
				'RU'
			];
		}

		PluginHelper::importPlugin('wishboxcdek');

		$this->getDispatcher()->dispatch(
			'onWishboxCdekOfficesUpdaterBeforeUpdate',
			new BeforeUpdateEvent(
				'onWishboxCdekOfficesUpdaterBeforeUpdate',
				[
					'subject'      => $this,
					'countryCodes' => $countryCodes,
					'limit'        => $limit,
				]
			)
		);

		$this->deleteAll();

		foreach ($countryCodes as $countryCode)
		{
			$firstPageResponse = $this->load($countryCode, 0, $limit);
			$total              = $firstPageResponse->totalElements;
			$totalPages         = $firstPageResponse->totalPages ?? 1;

			for ($page = 1; $page < $totalPages; $page++)
			{
				$this->load($countryCode, $page, $limit, $total);
			}
		}

		$this->getDispatcher()->dispatch(
			'onWishboxCdekOfficesUpdaterAfterUpdate',
			new AfterUpdateEvent(
				'onWishboxCdekOfficesUpdaterAfterUpdate',
				[
					'subject'      => $this,
					'countryCodes' => $countryCodes,
					'limit'        => $limit,
				]
			)
		);

		return true;
	}

	/**
	 * @param   string   $countryCode  Country code
	 * @param   integer  $page         Page
	 * @param   integer  $limit        Limit
	 * @param   integer|null  $total        Total
	 *
	 * @return DeliveryPointListResponse
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function load(string $countryCode, int $page = 0, int $limit = 100, ?int $total = null): DeliveryPointListResponse
	{
		$db         = $this->getDatabase();
		$dispatcher = $this->getDispatcher();

		$dispatcher->dispatch(
			'onWishboxCdekOfficesUpdaterBeforeLoad',
			new BeforeLoadEvent(
				'onWishboxCdekOfficesUpdaterBeforeLoad',
				[
					'subject'     => $this,
					'countryCode' => $countryCode,
					'page'        => $page,
					'limit'       => $limit,
					'total'       => $total,
				]
			)
		);

		$deliveryPointListResponse = $this->getCdekClient()
			->deliveryPoints()
			->getList(
				new GetDeliveryPointsRequest(
					countryCode: $countryCode,
					type: DeliveryPointType::ALL,
					page: $page,
					size: $limit
				)
			);

		$deliveryPoints            = $deliveryPointListResponse->items;
		$total                     = $deliveryPointListResponse->totalElements ?? $total;

		if (!count($deliveryPoints))
		{
			$this->getDispatcher()->dispatch(
				'onWishboxCdekOfficesUpdaterAfterLoad',
				new AfterLoadEvent(
					'onWishboxCdekOfficesUpdaterAfterLoad',
					[
						'subject'                => $this,
						'deliveryPointResponses' => $deliveryPoints,
						'countryCode'            => $countryCode,
						'page'                   => $page,
						'limit'                  => $limit,
						'total'                  => $total,
					]
				)
			);

			return $deliveryPointListResponse;
		}

		static $codes = [];
		$query = $db->createQuery()
			->insert($db->qn('#__wishboxcdek_offices'))
			->columns(
				[
					$db->qn('id'),
					$db->qn('code'),
					$db->qn('country_code'),
					$db->qn('region_code'),
					$db->qn('city_code'),
					$db->qn('city'),
					$db->qn('work_time'),
					$db->qn('address'),
					$db->qn('address_full'),
					$db->qn('phone'),
					$db->qn('note'),
					$db->qn('location_longitude'),
					$db->qn('location_latitude'),
					$db->qn('type'),
					$db->qn('owner_code'),
					$db->qn('is_dressing_room'),
					$db->qn('have_cashless'),
					$db->qn('allowed_cod'),
					$db->qn('nearest_station'),
					$db->qn('nearest_metro_station'),
					$db->qn('site'),
					$db->qn('office_images_list'),
					$db->qn('work_time_list'),
					$db->qn('weight_min'),
					$db->qn('weight_max'),
					$db->qn('dimensions')
				]
			);

		foreach ($deliveryPoints as $item)
		{
			$id   = 0;
			$code = $item->code;

			if (in_array($code, $codes))
			{
				continue;
			}

			$deliveryPointCountryCode = $item->location->countryCode;
			$regionCode               = $item->location->regionCode;
			$cityCode                 = $item->location->cityCode;
			$city                     = $item->location->city;
			$workTime                 = $item->workTime;
			$address                  = $item->location->address;
			$addressFull              = $item->location->addressFull;
			$phones                   = $item->phones;
			$phoneNumbers             = [];

			if (count($phones))
			{
				foreach ($phones as $phone)
				{
					$phoneNumbers[] = $phone->number;
				}
			}

			$phone = '';

			if (count($phones))
			{
				$phone = implode(', ', $phoneNumbers);
			}

			$note              = $item->note ?? '';
			$locationLongitude = $item->location->longitude;
			$locationLatitude  = $item->location->latitude;
			$type              = $item->type;
			$ownerCode         = $item->ownerCode;
			$isDressingRoom    = $item->isDressingRoom;
			$haveCashless      = $item->haveCashless;
			$allowedCod        = $item->allowedCod;
			$nearestStation    = $item->nearestStation ?? '';
			$metroStation      = $item->nearestMetroStation ?? '';
			$site              = $item->site ?? '';
			$officeImagesList  = json_encode($item->officeImageList);
			$workTimeList      = json_encode($item->workTimeList);
			$weightMin         = $item->weightMin ?? 0;
			$weightMax         = $item->weightMax ?? 0;

			$dimensions = '';

			if ($item->dimensions)
			{
				$arr = [];

				foreach ($item->dimensions as $dimension)
				{
					$arr[] = [
						'width'  => $dimension->width,
						'height' => $dimension->height,
						'depth'  => $dimension->depth,
					];
				}

				$dimensions = json_encode($arr);
			}

			$codes[] = $code;
			$query->values(
				implode(
					',',
					[
						$db->q($id),
						$db->q($code),
						$db->q($deliveryPointCountryCode),
						$db->q($regionCode),
						$db->q($cityCode),
						$db->q($city),
						$db->q($workTime),
						$db->q($address),
						$db->q($addressFull),
						$db->q($phone),
						$db->q($note),
						$db->q($locationLongitude),
						$db->q($locationLatitude),
						$db->q($type),
						$db->q($ownerCode),
						$db->q($isDressingRoom),
						$db->q($haveCashless),
						$db->q($allowedCod),
						$db->q($nearestStation),
						$db->q($metroStation),
						$db->q($site),
						$db->q($officeImagesList),
						$db->q($workTimeList),
						$db->q($weightMin),
						$db->q($weightMax),
						$db->q($dimensions)
					]
				)
			);
		}

		try
		{
			$db->setQuery($query);
			$db->execute();
		}
		catch (Exception $e)
		{
			throw $e;
		}

		$dispatcher->dispatch(
			'onWishboxCdekOfficesUpdaterAfterLoad',
			new AfterLoadEvent(
				'onWishboxCdekOfficesUpdaterAfterLoad',
				[
					'subject'                => $this,
					'deliveryPointResponses' => $deliveryPoints,
					'countryCode'            => $countryCode,
					'page'                   => $page,
					'limit'                  => $limit,
					'total'                  => $total,
				]
			)
		);

		return $deliveryPointListResponse;
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 */
	private function deleteAll(): void
	{
		$db = $this->getDatabase();

		/** @noinspection SqlWithoutWhere */
		$query = 'DELETE FROM #__wishboxcdek_offices;';
		$db->setQuery($query);
		$db->execute();

		$query = 'ALTER TABLE #__wishboxcdek_offices AUTO_INCREMENT = 1';

		$db->setQuery($query);
		$db->execute();
	}
}
