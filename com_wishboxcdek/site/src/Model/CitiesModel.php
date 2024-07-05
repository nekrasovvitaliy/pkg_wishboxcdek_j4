<?php
/**
 * @copyright  2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;
use stdClass;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class CitiesModel extends \Joomla\CMS\MVC\Model\BaseModel
{
	/**
	 * Constructor
	 *
	 * @param   string  $nameStartsWith  Name starts with
	 *
	 * @return array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getCitiesDataForAutocomplete(string $nameStartsWith): array
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$data = [];

		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		if (strlen($nameStartsWith) > $componentParams->get('min_length', 1))
		{
			$db->setQuery('SET SQL_BIG_SELECTS=1');
			$result = $db->execute();

			if (!$result)
			{
				throw new Exception('SET SQL_BIG_SELECTS=1 FALSE', 500);
			}

			$query = $db->getQuery(true)
				->select(
					[
						'city.code as id',
						'city.cityname',
						'city.sub_region',
						'city.oblname'
					]
				)
				->from($db->quoteName('#__wishboxcdek_cities', 'city'))
				->where('city.cityname LIKE ' . $db->q($nameStartsWith . '%'));
			$db->setQuery($query);
			$list = $db->loadObjectList();

			if (count($list))
			{
				foreach ($list as $item)
				{
					$result = new stdClass;
					$result->id = $item->id;
					$values = [];
					$values[] = $item->cityname;
					$values[] = $item->sub_region; // phpcs:ignore
					$values[] = $item->oblname;
					$values = array_diff($values, ['']);
					$result->cityname = $item->cityname;

					if (!empty($item->sub_region) && !mb_strpos($item->sub_region, $result->cityname)) // phpcs:ignore
					{
						$result->cityname .= ', ' . $item->sub_region; // phpcs:ignore
					}

					$result->name = implode(', ', $values);
					$result->oblname = $item->oblname;

					$data[] = $result;
				}
			}
		}

		return $data;
	}

	/**
	 * Constructor
	 *
	 * @param   string  $nameStartsWith  Name starts with
	 *
	 * @return array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getCitiesDataForAjaxSearch(string $nameStartsWith): array
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$data = [];

		$componentParams = ComponentHelper::getParams('com_wishboxcdek');

		if (strlen($nameStartsWith) > $componentParams->get('min_length', 1))
		{
			$db->setQuery('SET SQL_BIG_SELECTS=1');
			$result = $db->execute();

			if (!$result)
			{
				throw new Exception('SET SQL_BIG_SELECTS=1 FALSE', 500);
			}

			$query = $db->getQuery(true)
				->select('city.code')
				->select('city.cityname')
				->select('city.sub_region')
				->select('city.oblname')
				->from($db->quoteName('#__wishboxcdek_cities', 'city'))
				->where('city.cityname LIKE ' . $db->q($nameStartsWith . '%'));
			$db->setQuery($query);
			$list = $db->loadObjectList();

			if (count($list))
			{
				foreach ($list as $item)
				{
					$result = new stdClass;
					$result->value = $item->code;
					$values = [];
					$values[] = $item->cityname;
					$values[] = $item->sub_region; // phpcs:ignore
					$values[] = $item->oblname;
					$values = array_unique($values);
					$values = array_diff($values, ['']);

					$result->text = '';

					if (!empty($item->sub_region) && !mb_strpos($item->sub_region, $item->cityname)) // phpcs:ignore
					{
						$result->text .= ', ' . $item->sub_region; // phpcs:ignore
					}

					$result->text = implode(', ', $values);

					$data[] = $result;
				}
			}
		}

		return $data;
	}
}
