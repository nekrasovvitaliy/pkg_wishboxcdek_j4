<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Administrator\Table;

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
	 * @var string|null $code Status code
	 *
	 * @since 1.0.0
	 */
	public ?string $code = null;

	/**
	 * @var string|null $name Status name
	 *
	 * @since 1.0.0
	 */
	public ?string $name = null;

	/**
	 * @var string|null $description Status description
	 *
	 * @since 1.0.0
	 */
	public ?string $description = null;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since       1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__wishboxcdek_statuses', 'id', $db);
	}
}
