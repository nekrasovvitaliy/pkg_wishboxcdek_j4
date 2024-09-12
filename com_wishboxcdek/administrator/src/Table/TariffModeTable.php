<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since       1.0.0
 *
 * @noinspection PhpUnused
 */
class TariffModeTable extends Table
{
	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since   1.0.0
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__wishboxcdek_tariff_modes', 'id', $db);
	}
}
