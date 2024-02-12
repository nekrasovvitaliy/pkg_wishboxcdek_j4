<?php
/**
 * @copyright (c) 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model\Cities;

require_once JPATH_SITE . '/vendor/autoload.php';

use AntistressStore\CdekSDK2\CdekClientV2;
use AntistressStore\CdekSDK2\Entity\Requests\Location;
use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\Database\DatabaseDriver;

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
		$db = Factory::getContainer()->get(DatabaseDriver::class);
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		$countryCodes = $componentParams->get('country_codes', []);

		$request = (new Location)
			->setCountryCodes(implode(',', $countryCodes))
			->setPage($page)
			->setSize($limit);

		$apiClient = new CdekClientV2(
			$componentParams->get('account', ''),
			$componentParams->get('secure', ''),
			60.0
		);

		$citiesResponses = $apiClient->getCities($request);

		if (count($citiesResponses))
		{
			static $codes = [];
			$query = $db->getQuery(true)
				->insert('#__wishboxcdek_cities')
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
						$db->qn('postcodelist'),
						$db->qn('longitude'),
						$db->qn('latitude')
					]
				);

			foreach ($citiesResponses as $citiesResponse)
			{
				$id = 0;
				$code = $citiesResponse->getCode();

				if (in_array($code, $codes))
				{
					continue;
				}

				$countrycode = $citiesResponse->getCountryCode();
				$region = trim($citiesResponse->getRegion());

				if (!empty($region))
				{
					$oblname = $region;
				}
				else
				{
					$oblname = '';
				}

				$subRegion = trim($citiesResponse->getSubRegion() ?? '');

				// Если подрегион не совпадает с областью и не совпадает с городом
				if (mb_strtoupper($subRegion) == mb_strtoupper($oblname)
					|| mb_strtoupper($subRegion) == mb_strtoupper(trim($citiesResponse->getCity()))
				)
				{
					$subRegion = '';
				}

				$cityname = $citiesResponse->getCity();
				$fullname = [$cityname, $subRegion, $oblname];
				$fullname = array_diff($fullname, ['']);
				$fullname = array_unique($fullname);
				$fullname = implode(', ', $fullname);
				$nalsumlimit = 0;

				$postalCode = $citiesResponse->getPostalCode();

				if ($postalCode)
				{
					$postcodelist = $postalCode;
				}
				else
				{
					$postcodelist = '';
				}

				$longitude = $citiesResponse->getLongitude();
				$latitude = $citiesResponse->getLatitude();
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
							$db->q($postcodelist),
							$longitude,
							$latitude
						]
					)
				);
			}

			$db->setQuery($query);
			$db->execute();
		}

		return count($citiesResponses);
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
