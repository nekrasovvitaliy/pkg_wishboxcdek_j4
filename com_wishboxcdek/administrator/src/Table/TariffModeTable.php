<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Administrator\Table;

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
	 * @var integer $id Id
	 *
	 * @since 1.0.0
	 */
	public int $id = 0;

	/**
	 * @var integer|null $code Tariff mode code
	 *
	 * @since 1.0.0
	 */
	public ?int $code = null;

	/**
	 * @var string|null $title Tariff mode title
	 *
	 * @since 1.0.0
	 */
	public ?string $title = null;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since   1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__wishboxcdek_tariff_modes', 'id', $db);
	}
}
