<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Service\Html;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Joomla\Database\DatabaseAwareTrait;
use Joomla\Database\DatabaseDriver;

/**
 * Wishboxcdek HTML Helper.
 *
 * @since  1.0.0
 */
class Wishboxcdek
{
	use DatabaseAwareTrait;

	/**
	 * Public constructor.
	 *
	 * @param   DatabaseDriver  $db  The Joomla DB driver object for the site's database.
	 *
	 * @since 1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{

	}
}
