<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vёitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Service\City;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use WishboxCdekLibrary\Event\Service\Cities\Updater\AfterLoadCitiesEvent;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\DatabaseInterface;
use WishboxCdek\CdekClient;
use WishboxCdek\Request\Location\GetCitiesRequest;
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
class CitiesUpdaterService implements CdekClientAwareInterface, DatabaseAwareInterface
{
	use DatabaseAwareTrait;
	use CdekClientAwareTrait;

	/**
	 * Class constructor.
	 *
	 * @param   DatabaseInterface  $db          Database driver
	 * @param   CdekClient         $cdekClient  CDEK client
	 *
	 * @since 1.0.0
	 */
	public function __construct(DatabaseInterface $db, CdekClient $cdekClient)
	{
		$this->setDatabase($db);
		$this->setCdekClient($cdekClient);
	}

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
		$app             = Factory::getApplication();
		$db              = $this->getDatabase();
		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		$countryCodes = $componentParams->get('country_codes', []);

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

		$apiClient = $this->getCdekClient();

		$cities = $apiClient->locations()->getCities(
			new GetCitiesRequest(
				countryCodes: implode(',', $countryCodes),
				page: $page,
				size: $limit,
			)
		);

		if (count($cities))
		{
			static $codes = [];
			$query = $db->createQuery()
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

			foreach ($cities as $cityResponse)
			{
				$id   = 0;
				$code = $cityResponse->code;

				if (in_array($code, $codes))
				{
					continue;
				}

				$countrycode = $cityResponse->countryCode;
				$region      = trim($cityResponse->region);

				if (!empty($region))
				{
					$oblname = $region;
				}
				else
				{
					$oblname = '';
				}

				$subRegion = trim($cityResponse->subRegion ?? '');

				// Если подрегион совпадает с областью или совпадает с городом
				if (mb_strtoupper($subRegion) == mb_strtoupper($oblname)
					|| mb_strtoupper($subRegion) == mb_strtoupper(trim($cityResponse->city ?? ''))
				)
				{
					$subRegion = '';
				}

				$cityname    = $cityResponse->city;
				$fullname    = [$cityname, $subRegion, $oblname];
				$fullname    = array_diff($fullname, ['']);
				$fullname    = array_unique($fullname);
				$fullname    = implode(', ', $fullname);
				$nalsumlimit = 0;

				$longitude = (float) $cityResponse->longitude;
				$latitude  = (float) $cityResponse->latitude;
				$codes[]   = $code;
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
							$longitude, // float|null
							$latitude   // float|null
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
				$stringQuery = (string) $query;
				$app->enqueueMessage($e->getMessage() . $stringQuery, 'warning');

				throw $e;
			}

			PluginHelper::importPlugin('wishboxcdek');

			/** @var AfterLoadCitiesEvent $event */
			$event = AbstractEvent::create(
				'onWishboxCdekCitiesUpdaterAfterLoadCities',
				[
					'subject'       => $this,
					'cityResponses' => $cities,
					'page'          => $page,
					'limit'         => $limit,
					'eventClass'    => AfterLoadCitiesEvent::class,
				]
			);

			$app->getDispatcher()->dispatch($event->getName(), $event);
		}

		return count($cities);
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 */
	private function deleteAll(): void
	{
		$db    = $this->getDatabase();
		$query = 'TRUNCATE #__wishboxcdek_cities;';
		$db->setQuery($query);
		$db->execute();
	}
}
