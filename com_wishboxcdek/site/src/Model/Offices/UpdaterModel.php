<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Offices;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Database\DatabaseDriver;
use ReflectionException;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Model\Request\DeliveryPoints\DeliveryPointsGetRequest;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPointResponse;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
class UpdaterModel extends BaseDatabaseModel
{
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
		$this->deleteAll();

		$page = 0;

		while (true)
		{
			$count = $this->loadOffices($page, $limit);

			if ($count == $limit)
			{
				$page++;
			}
			else
			{
				break;
			}
		}

		return true;
	}

	/**
	 * @param   integer  $page   Page
	 * @param   integer  $limit  Limit
	 *
	 * @return integer
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function loadOffices(int $page = 0, int $limit = 1000): int
	{
		$app = Factory::getApplication();
		$db  = $this->getDatabase();

		$deliveryPointResponses = $this->getDeliveryPointsResponses($page, $limit);

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

		foreach ($deliveryPointResponses as $item)
		{
			$id = 0;
			$code = $item->getCode();

			if (in_array($code, $codes))
			{
				continue;
			}

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
			$metroStation = $item->getNearestMetroStation() ?? '';
			$site = $item->getSite() ?? '';
			$officeImagesList = json_encode($item->getOfficeImageList());
			$workTimeList = json_encode($item->getWorkTimeList());
			$weightMin = $item->getWeightMin() ?? 0;
			$weightMax = $item->getWeightMax() ?? 0;

			$dimensions = '';

			if ($item->getDimensions())
			{
				$arr = [];

				foreach ($item->getDimensions() as $dimension)
				{
					$arr[] = [
						'width' => $dimension->getWidth(),
						'height' => $dimension->getHeight(),
						'depth' => $dimension->getDepth(),
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

		try
		{
			$db->setQuery($query);
			$db->execute();
		}
		catch (Exception $e)
		{
			echo str_replace('#__', $app->get('dbprefix'), (string) $query);

			die;
		}

		return count($deliveryPointResponses);
	}

	/**
	 * @param   integer  $page   Page
	 * @param   integer  $limit  Limit
	 *
	 * @return DeliveryPointResponse[]
	 *
	 * @throws ReflectionException|Exception
	 *
	 * @since 1.0.0
	 */
	private function getDeliveryPointsResponses(int $page = 0, int $limit = 1000): array
	{
		$deliveryPointResponses = [];
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$countryCodes = $componentParams->get('country_codes', []);

		if (!count($countryCodes))
		{
			throw new Exception('No country selected in component arameters.', 500);
		}

		foreach ($countryCodes as $countryCode)
		{
			$requestPvz = (new DeliveryPointsGetRequest)
				->setType('ALL')
				->setCountryCode($countryCode)
				->setPage($page)
				->setSize($limit);

			$deliveryPointResponses = array_merge(
				$deliveryPointResponses,
				$apiClient->getDeliveryPoints($requestPvz)
			);
		}

		return $deliveryPointResponses;
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
