<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Table;

use Joomla\CMS\Factory;
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
class OfficeTable extends BaseTable
{
	/**
	 * @var string|null $code Code
	 *
	 * @since 1.0.0
	 */
	public ?string $code;

	/**
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	public ?string $addres;

	/**
	 * @param   DatabaseDriver  $db  Database driver
	 *
	 * @since 1.0.0
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__wishboxcdek_offices', 'id', $db);
	}

	/**
	 * @param   integer       $cityCode    City code
	 * @param   boolean|null  $allowedCod  Разрешен наложенный платеж
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getItems(int $cityCode, ?bool $allowedCod = null): array
	{
		$db = Factory::getContainer()->get(DatabaseDriver::class);

		$query = $db->getQuery(true)
			->select(
				[
					'o.code',
					'o.address AS name'
				]
			)
			->from('#__wishboxcdek_offices AS o')
			->where('o.city_code = ' . $cityCode);

		if ($allowedCod)
		{
			$query->where('allowed_cod = ' . (int) $allowedCod);
		}

		$query->order('address');
		$db->setQuery($query);

		return $db->loadObJectList();
	}
}
