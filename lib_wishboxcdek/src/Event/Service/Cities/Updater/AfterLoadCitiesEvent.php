<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace WishboxCdekLibrary\Event\Service\Cities\Updater;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdek\Response\Location\CityDto;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class AfterLoadCitiesEvent extends AbstractEvent
{
	/**
	 * Setter for the citiesResponses argument.
	 *
	 * @param   CityDto[]  $value  The value to set
	 *
	 * @return  array
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetCityResponses(array $value): array
	{
		if (empty($value))
		{
			throw new Exception('Value must be not empty');
		}

		return $value;
	}

	/**
	 * Setter for the page argument.
	 *
	 * @param   integer  $value  The value to set
	 *
	 * @return  integer
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetPage(int $value): int
	{
		return $value;
	}

	/**
	 * Setter for the limit argument.
	 *
	 * @param   integer  $value  The value to set
	 *
	 * @return  integer
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * Getter for the cityResponses argument.
	 *
	 * @param   CityDto[]  $value  Value
	 *
	 * @return  CityDto[]
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetCityResponses(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the page argument.
	 *
	 * @param   integer  $value  Value
	 *
	 * @return  integer
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetPage(int $value): int
	{
		return $value;
	}

	/**
	 * Getter for the limit argument.
	 *
	 * @param   integer  $value  Value
	 *
	 * @return  integer
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * @return  CityDto[]
	 *
	 * @since  1.0.0
	 * @noinspection PhpUnused
	 */
	public function getCityResponses(): array
	{
		return $this->getArgument('cityResponses');
	}

	/**
	 * @return integer
	 *
	 * @since  1.0.0
	 */
	public function getPage(): int
	{
		return $this->getArgument('page');
	}

	/**
	 * @return integer
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLimit(): int
	{
		return $this->getArgument('limit');
	}
}
