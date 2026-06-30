<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Administrator\Model;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Methods supporting a list of article records.
 *
 * @since  1.0.0
 */
class DashboardModel extends BaseDatabaseModel implements CdekClientAwareInterface
{
	use CdekClientAwareTrait;

	/**
	 * @return integer
	 *
	 * @since 1.0.0
	 */
	public function getCitiesCount(): int
	{
		$db = $this->getDatabase();
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
		$db = $this->getDatabase();
		$db->setQuery('SELECT COUNT(id) FROM #__wishboxcdek_offices');

		return (int) $db->loadResult();
	}
}
