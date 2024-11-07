<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Cities;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Component\Wishboxcdek\Administrator\Event\Model\OrderStatusUpdater\AfterLoadCitiesEvent;
use Joomla\Database\DatabaseDriver;
use WishboxCdekSDK2\CdekClientV2;
use WishboxCdekSDK2\Model\Request\Location\CitiesGetRequest;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property DatabaseDriver    $db
 *
 * @since 1.0.0
 */
class UpdaterModel extends BaseModel
{
	/**
	 * @param   integer  $limit  Limit
	 *
	 * @return boolean
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function update(int $limit = 10000): bool
	{
//		if (!set_time_limit(300))
//		{
//			throw new Exception('set_time_limit return false', 500);
//		}

		$this->deleteAll();

		$page = 0;

		while (true)
		{
			$count = $this->loadCities($page, $limit);

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
	public function loadCities(int $page = 0, int $limit = 1000): int
	{
		$app = Factory::getApplication();
		$db = Factory::getContainer()->get(DatabaseDriver::class);
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		$countryCodes = $componentParams->get('country_codes', []);

		$request = (new CitiesGetRequest)
			->setCountryCodes(implode(',', $countryCodes))
			->setPage($page)
			->setSize($limit);

		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$cityResponses = $apiClient->getCities($request);

		if (count($cityResponses))
		{
			static $codes = [];
			$query = $db->getQuery(true)
				->insert($db->qn('#__wishboxcdek_cities'))
				->columns(
					[
						$db->qn('id'),
						$db->qn('code'),
						$db->qn('fullname'),
						$db->qn('cityname'),
						$db->qn('sub_region'),
						$db->qn('oblname'),
						$db->qn('countrycode'),
						$db->qn('nalsumlimit'),
						$db->qn('longitude'),
						$db->qn('latitude')
					]
				);

			foreach ($cityResponses as $cityResponse)
			{
				$id = 0;
				$code = $cityResponse->getCode();

				if (in_array($code, $codes))
				{
					continue;
				}

				$countrycode = $cityResponse->getCountryCode();
				$region = trim($cityResponse->getRegion());

				if (!empty($region))
				{
					$oblname = $region;
				}
				else
				{
					$oblname = '';
				}

				$subRegion = trim($cityResponse->getSubRegion() ?? '');

				// Если подрегион не совпадает с областью и не совпадает с городом
				if (mb_strtoupper($subRegion) == mb_strtoupper($oblname)
					|| mb_strtoupper($subRegion) == mb_strtoupper(trim($cityResponse->getCity()))
				)
				{
					$subRegion = '';
				}

				$cityname = $cityResponse->getCity();
				$fullname = [$cityname, $subRegion, $oblname];
				$fullname = array_diff($fullname, ['']);
				$fullname = array_unique($fullname);
				$fullname = implode(', ', $fullname);
				$nalsumlimit = 0;

				$longitude = $cityResponse->getLongitude();
				$latitude = $cityResponse->getLatitude();
				$codes[] = $code;
				$query->values(
					implode(
						',',
						[
							$id,
							$code,
							$db->q($fullname),
							$db->q($cityname),
							$db->q($subRegion),
							$db->q($oblname),
							$db->q($countrycode),
							$db->q($nalsumlimit),
							$longitude,
							$latitude
						]
					)
				);
			}

			$db->setQuery($query);
			$db->execute();
			PluginHelper::importPlugin('wishboxcdek');

			/** @var AfterLoadCitiesEvent $event */
			$event = AbstractEvent::create(
				'onWishboxCdekCitiesUpdaterAfterLoadCities',
				[
					'subject'       => $this,
					'cityResponses' => $cityResponses,
					'page'          => $page,
					'limit'         => $limit,
				]
			);
			$app->getDispatcher()->dispatch('onWishboxCdekCitiesUpdaterAfterLoadCities', $event);
		}

		return count($cityResponses);
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 */
	private function deleteAll(): void
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);
		$query = 'TRUNCATE #__wishboxcdek_cities;';
		$db->setQuery($query);
		$db->execute();
	}
}
