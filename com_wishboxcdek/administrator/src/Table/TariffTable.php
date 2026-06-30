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
class TariffTable extends Table
{
	/**
	 * @var integer $id Id
	 *
	 * @since 1.0.0
	 */
	public int $id = 0;

	/**
	 * @var integer|null $code Tariff code
	 *
	 * @since 1.0.0
	 */
	public ?int $code = null;

	/**
	 * @var integer|null $published Published state
	 *
	 * @since 1.0.0
	 */
	public ?int $published = null;

	/**
	 * @var string|null $name Tariff name
	 *
	 * @since 1.0.0
	 */
	public ?string $name = null;

	/**
	 * @var integer|null $mode Tariff mode
	 *
	 * @since 1.0.0
	 */
	public ?int $mode = null;

	/**
	 * @var string|null $weight_limit Weight limit
	 *
	 * @since 1.0.0
	 */
	public ?string $weight_limit = null;

	/**
	 * @var string|null $service Service
	 *
	 * @since 1.0.0
	 */
	public ?string $service = null;

	/**
	 * @var string|null $description Description
	 *
	 * @since 1.0.0
	 */
	public ?string $description = null;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since   1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__wishboxcdek_tariffs', 'id', $db);
	}
}
