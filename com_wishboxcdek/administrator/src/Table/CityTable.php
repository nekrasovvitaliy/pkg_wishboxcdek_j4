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
 * @since       1.0.0
 *
 * @noinspection PhpUnused
 */
class CityTable extends BaseTable
{
	/**
	 * @var integer|null $code City code
	 *
	 * @since 1.0.0
	 */
	public ?int $code = null;

	/**
	 * @var string|null $fullname Full city name
	 *
	 * @since 1.0.0
	 */
	public ?string $fullname = null;

	/**
	 * @var string|null $cityname City name
	 *
	 * @since 1.0.0
	 */
	public ?string $cityname = null;

	/**
	 * @var string|null $sub_region City subregion
	 *
	 * @since 1.0.0
	 */
	public ?string $sub_region = null;

	/**
	 * @var string|null $oblname Region name
	 *
	 * @since 1.0.0
	 */
	public ?string $oblname = null;

	/**
	 * @var string|null $countrycode Country code
	 *
	 * @since 1.0.0
	 */
	public ?string $countrycode = null;

	/**
	 * @var string|null $nalsumlimit Cash limit
	 *
	 * @since 1.0.0
	 */
	public ?string $nalsumlimit = null;

	/**
	 * @var float|null $longitude Longitude
	 *
	 * @since 1.0.0
	 */
	public ?float $longitude = null;

	/**
	 * @var float|null $latitude Latitude
	 *
	 * @since 1.0.0
	 */
	public ?float $latitude = null;

	/**
	 * @param   DatabaseDriver $db Database driver
	 *
	 * @since 1.0.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__wishboxcdek_cities', 'id', $db);
	}
}
