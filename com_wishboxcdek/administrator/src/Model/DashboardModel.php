<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Database\DatabaseDriver;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Methods supporting a list of article records.
 *
 * @since  1.6
 */
class DashboardModel extends BaseDatabaseModel
{
	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCitiesCount(): int
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);
		$db->setQuery('SELECT COUNT(id) FROM #__wishboxcdek_cities');

		return (int) $db->loadResult();
	}

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getOfficesCount(): int
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);
		$db->setQuery('SELECT COUNT(id) FROM #__wishboxcdek_offices');

		return (int) $db->loadResult();
	}
}
