<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

require_once JPATH_SITE . '/vendor/autoload.php';

use AntistressStore\CdekSDK2\CdekClientV2;
use AntistressStore\CdekSDK2\Entity\Requests\DeliveryPoints;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
class UpdaterModel extends BaseModel
{
	/**
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	public function update(): bool
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		/** @noinspection SqlWithoutWhere */
		$query = 'DELETE FROM #__wishboxcdek_offices;';
		$db->setQuery($query);
		$db->execute();

		$query = 'ALTER TABLE #__wishboxcdek_offices AUTO_INCREMENT = 1';

		$db->setQuery($query);
		$db->execute();

		$countryCodes = $componentParams->get('country_codes', []);
		$requestPvz = (new DeliveryPoints)
			->setType('ALL')
			->setCountryCodes($countryCodes);

		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$responsePvz = $apiClient->getDeliveryPoints($requestPvz);
		static $codes = [];
		$query = $db->getQuery(true)
			->insert($db->quoteName('#__wishboxcdek_offices'))
			->columns(
				[
					$db->qn('id'),
					$db->qn('code'),
					$db->qn('name'),
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
					$db->qn('metro_station'),
					$db->qn('site'),
					$db->qn('office_images_list'),
					$db->qn('work_time_list'),
					$db->qn('weight_min'),
					$db->qn('weight_max'),
					$db->qn('dimensions')
				]
			);

		foreach ($responsePvz as $item)
		{
			$id = 0;
			$code = $item->getCode();

			if (in_array($code, $codes))
			{
				continue;
			}

			$name = $item->getName();

			$countryCode = $item->getLocation()->getCountryCode();

			$regionCode = $item->getLocation()->getRegionCode();
			$cityCode = $item->getLocation()->getCityCode();
			$city = $item->getLocation()->getCity();
			$workTime = $item->getWorkTime();
			$address = $item->getLocation()->getAddress();
			$addressFull = $item->getLocation()->getAddressFull();
			$phones = $item->getPhones();
			$phoneNumbers = [];

			if (count($phones))
			{
				foreach ($phones as $phone)
				{
					$phoneNumbers[] = $phone->getNumber();
				}
			}

			$phone = '';

			if (count($phones))
			{
				$phone = implode(', ', $phoneNumbers);
			}

			$note = $item->getNote() ?? '';
			$locationLongitude = $item->getLocation()->getLongitude();
			$locationLatitude = $item->getLocation()->getLatitude();
			$type = $item->getType();
			$ownerCode = $item->getOwnerCode();

			$isDressingRoom = $item->getIsDressingRoom();
			$haveCashless = $item->getHaveCashless();
			$allowedCod = $item->getAllowedCod();
			$nearestStation = $item->getNearestStation() ?? '';
			$metroStation = $item->getNearestMetroStation() ? $item->getNearestMetroStation() : '';
			$site = $item->getSite() ? $item->getSite() : '';
			$officeImagesList = json_encode($item->getOfficeImageList());
			$workTimeList = json_encode($item->getWorkTimeList());
			$weightMin = $item->getWeightMin() ?? 0;
			$weightMax = $item->getWeightMax() ?? 0;
			$dimensions = '';

			if ($item->getDimensions())
			{
				$dimensions = json_encode($item->getDimensions());
			}

			$codes[] = $code;
			$query->values(
				implode(
					',',
					[
							$db->q($id),
							$db->q($code),
							$db->q($name),
							$db->q($countryCode),
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

		$db->setQuery($query);
		$db->execute();

		return true;
	}
}
