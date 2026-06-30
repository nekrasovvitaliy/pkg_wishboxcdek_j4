<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace WishboxCdekLibrary\Event\Service\Offices\Updater;

use Joomla\CMS\Event\AbstractEvent;
use WishboxCdek\Response\DeliveryPoint\OfficeDto;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class LoadEvent extends AbstractEvent
{
	/**
	 * Setter for the countryCode argument.
	 *
	 * @param   string  $value  The value to set
	 *
	 * @return  string
	 *
	 * @since        1.0.0
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
	 * @since        1.0.0
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
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * Setter for the total argument.
	 *
	 * @param   integer|null  $value  The value to set
	 *
	 * @return  integer|null
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetTotal(?int $value): ?int
	{
		return $value;
	}

	/**
	 * Setter for the deliveryPointResponses argument.
	 *
	 * @param   OfficeDto[]  $value  The value to set
	 *
	 * @return  array
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onSetDeliveryPointResponses(array $value): array
	{
		return $value;
	}

	/**
	 * Getter for the countryCode argument.
	 *
	 * @param   string  $value  Value
	 *
	 * @return  string
	 *
	 * @since        1.0.0
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
	 * @since        1.0.0
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
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetLimit(int $value): int
	{
		return $value;
	}

	/**
	 * Getter for the total argument.
	 *
	 * @param   integer|null  $value  Value
	 *
	 * @return  integer|null
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetTotal(?int $value): ?int
	{
		return $value;
	}

	/**
	 * Getter for the deliveryPointResponses argument.
	 *
	 * @param   OfficeDto[]  $value  Value
	 *
	 * @return  OfficeDto[]
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	protected function onGetDeliveryPointResponses(array $value): array
	{
		return $value;
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
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getLimit(): int
	{
		return $this->getArgument('limit');
	}

	/**
	 * @return integer|null
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTotal(): ?int
	{
		return $this->getArgument('total');
	}

	/**
	 * @return  OfficeDto[]
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDeliveryPointResponses(): array
	{
		return $this->getArgument('deliveryPointResponses');
	}

	/**
	 * @return  OfficeDto[]
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOfficeResponses(): array
	{
		return $this->getDeliveryPointResponses();
	}
}
