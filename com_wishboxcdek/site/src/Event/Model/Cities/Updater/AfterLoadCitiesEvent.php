<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Event\Model\OrderStatusUpdater;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdekSDK2\Model\Response\Location\CitiesGet\CityResponse;
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
	 * @param   CityResponse[]  $value  The value to set
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
	 * @param   CityResponse[]  $value  Value
	 *
	 * @return  CityResponse[]
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
	 * @return  CityResponse[]
	 *
	 * @since  1.0.0
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
	 */
	public function getLimit(): int
	{
		return $this->getArgument('limit');
	}
}
