<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 *
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace WishboxCdekLibrary\Event\Service\CalculatorAdapter;

use Joomla\CMS\Event\AbstractEvent;
use Joomla\CMS\Event\Result\ResultAware;
use Joomla\CMS\Event\Result\ResultAwareInterface;
use Joomla\CMS\Event\Result\ResultTypeObjectAware;
use WishboxCdek\Request\Calculator\CalcPackageRequestDto;
use WishboxCdekLibrary\Interface\CalculatorAdapterInterface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class GetPackagesEvent extends AbstractEvent implements ResultAwareInterface
{
	use ResultAware;
	use ResultTypeObjectAware;

	/**
	 * @param   string  $eventName  Event name
	 * @param   array   $arguments  Arguments
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $eventName, array $arguments)
	{
		parent::__construct($eventName, $arguments);

		$this->resultAcceptableClasses = [CalcPackageRequestDto::class];
	}

	/**
	 * @param   CalculatorAdapterInterface  $value  Subject
	 *
	 * @return CalculatorAdapterInterface
	 *
	 * @since 1.0.0
	 */
	protected function onSetSubject(CalculatorAdapterInterface $value): CalculatorAdapterInterface
	{
		return $value;
	}

	/**
	 * @return CalculatorAdapterInterface
	 *
	 * @since 1.0.0
	 */
	public function getCalculatorAdapter(): CalculatorAdapterInterface
	{
		return $this->getArgument('subject');
	}

	/**
	 * @return CalcPackageRequestDto[]
	 *
	 * @since 1.0.0
	 */
	public function getPackages(): array
	{
		return $this->getArgument('result') ?? [];
	}
}
