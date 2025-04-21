<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Table;

use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @package     Joomla\Component\Jshopping\Site\Table
 *
 * @since       1.0.0
 *
 * @noinspection PhpUnused
 */
class StatusTable extends BaseTable
{
	/**
	 * @param   DatabaseDriver $_db Database driver
	 *
	 * @since       1.0.0
	 */
	public function __construct(&$_db)
	{
		parent::__construct('#__wishboxcdek_statuses', 'id', $_db);
	}
}
