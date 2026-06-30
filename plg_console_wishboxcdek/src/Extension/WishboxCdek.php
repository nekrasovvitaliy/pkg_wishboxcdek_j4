<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Plugin\Console\WishboxCdek\Extension;

use Exception;
use Joomla\Application\ApplicationEvents;
use Joomla\CMS\Application\ConsoleApplication;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\DispatcherAwareTrait;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\DispatcherAwareInterface;
use Joomla\Event\SubscriberInterface;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateCitiesCommand;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateOfficesCommand;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateOrderStatutesCommand;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use WishboxCdekLibrary\Event\Service\Cities\Updater\AfterLoadCitiesEvent;
use WishboxCdekLibrary\Event\Service\Offices\Updater\AfterLoadEvent;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
final class WishboxCdek extends CMSPlugin implements DispatcherAwareInterface,
	CdekClientAwareInterface,
	SubscriberInterface
{
	use CdekClientAwareTrait;
	use DatabaseAwareTrait;
	use DispatcherAwareTrait;

	/**
	 * @var ConsoleSectionOutput|null
	 *
	 * @since 1.0.0
	 */
	protected ?ConsoleSectionOutput $pageSection = null;

	/**
	 * @return string[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			ApplicationEvents::BEFORE_EXECUTE           => 'registerCommands',
			'onWishboxCdekCitiesUpdaterAfterLoadCities' => 'onWishboxCdekCitiesUpdaterAfterLoadCities',
			'onWishboxCdekOfficesUpdaterAfterLoad'      => 'onWishboxCdekOfficesUpdaterAfterLoad',
		];
	}

	/**
	 * @return void
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function registerCommands(): void
	{
		/** @var ConsoleApplication $app */
		$app = $this->getApplication();

		$commands = [
			UpdateCitiesCommand::class,
			UpdateOfficesCommand::class,
			UpdateOrderStatutesCommand::class
		];

		foreach ($commands as $commandClass)
		{
			$command = new $commandClass;

			if ($command instanceof DispatcherAwareInterface)
			{
				$command->setDispatcher($this->getDispatcher());
			}

			if ($command instanceof CdekClientAwareInterface)
			{
				$command->setCdekClient($this->getCdekClient());
			}

			if ($command instanceof DatabaseAwareInterface)
			{
				$command->setDatabase($this->getDatabase());
			}

			$app->addCommand($command);
		}
	}

	/**
	 * @param   AfterLoadCitiesEvent  $event  Event
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onWishboxCdekCitiesUpdaterAfterLoadCities(AfterLoadCitiesEvent $event): void
	{
		$page = $event->getPage();

		/** @var ConsoleApplication $app */
		$app = $this->getApplication();

		if (!$this->pageSection)
		{
			$consoleOutput     = $app->getConsoleOutput();
			$this->pageSection = $consoleOutput->section();
		}

		$this->pageSection->overwrite('Page ' . $page . ' loaded');
	}

	/**
	 * @param   AfterLoadEvent  $event  Event
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onWishboxCdekOfficesUpdaterAfterLoad(AfterLoadEvent $event): void
	{
		$countryCode = $event->getCountryCode();
		$page        = $event->getPage();

		/** @var ConsoleApplication $app */
		$app = $this->getApplication();

		if (!$this->pageSection)
		{
			$consoleOutput     = $app->getConsoleOutput();
			$this->pageSection = $consoleOutput->section();
		}

		$this->pageSection->overwrite('Country: ' . $countryCode . ' Page #' . $page . ' loaded');
	}
}
