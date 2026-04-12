<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\WishboxCdek\Site\Event\Model\Offices\Updater;

use Exception;
use Joomla\CMS\Event\AbstractEvent;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPointResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class AfterLoadOfficesEvent extends AbstractEvent
{
	/**
	 * Setter for the citiesResponses argument.
	 *
	 * @param   DeliveryPointResponse[]  $value  The value to set
	 *
	 * @return  array
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetOfficeResponses(array $value): array
	{
		if (empty($value))
		{
			throw new Exception('Value must be not empty');
		}

		return $value;
	}

	/**
	 * Setter for the countryCode argument.
	 *
	 * @param   string  $value  The value to set
	 *
	 * @return  string
	 *
	 * @throws Exception
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetCountryCode(string $value): string
	{
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
	 * Getter for the officeResponses argument.
	 *
	 * @param   DeliveryPointResponse[]  $value  Value
	 *
	 * @return  DeliveryPointResponse[]
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetOfficeResponses(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the countryCode argument.
	 *
	 * @param   string $value  Value
	 *
	 * @return  string
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetCountryCode(string $value): string
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
	 * @return  DeliveryPointResponse[]
	 *
	 * @since  1.0.0
	 */
	public function getOfficeResponses(): array
	{
		return $this->getArgument('deliveryPointResponses');
	}

	/**
	 * @return string
	 *
	 * @since  1.0.0
	 */
	public function getCountryCode(): string
	{
		return $this->getArgument('countryCode');
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
