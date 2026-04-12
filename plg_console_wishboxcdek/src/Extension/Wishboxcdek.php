<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Console\WishboxCdek\Extension;

use Exception;
use Joomla\Application\ApplicationEvents;
use Joomla\CMS\Application\ConsoleApplication;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Component\WishboxCdek\Site\Event\Model\Cities\Updater\AfterLoadCitiesEvent;
use Joomla\Component\WishboxCdek\Site\Event\Model\Offices\Updater\AfterLoadOfficesEvent;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\SubscriberInterface;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateCitiesCommand;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateOfficesCommand;
use Joomla\Plugin\Console\WishboxCdek\Console\Command\UpdateOrderStatutesCommand;
use Symfony\Component\Console\Output\ConsoleSectionOutput;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
final class WishboxCdek extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;
	use DatabaseAwareTrait;

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
			ApplicationEvents::BEFORE_EXECUTE               => 'registerCommands',
			'onWishboxCdekCitiesUpdaterAfterLoadCities'     => 'onWishboxCdekCitiesUpdaterAfterLoadCities',
			'onWishboxCdekOfficesUpdaterAfterLoadOffices'     => 'onWishboxCdekOfficesUpdaterAfterLoadOffices',
		];
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
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
			$command->setMVCFactory($this->getMVCFactory());
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
	 * @since 1.0.0
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
			$consoleOutput = $app->getConsoleOutput();
			$this->pageSection = $consoleOutput->section();
		}

		$this->pageSection->overwrite('Page ' . $page . ' loaded');
	}

	/**
	 * @param   AfterLoadOfficesEvent  $event  Event
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onWishboxCdekOfficesUpdaterAfterLoadOffices(AfterLoadOfficesEvent $event): void
	{
		$countryCode    = $event->getCountryCode();
		$page           = $event->getPage();

		/** @var ConsoleApplication $app */
		$app = $this->getApplication();

		if (!$this->pageSection)
		{
			$consoleOutput = $app->getConsoleOutput();
			$this->pageSection = $consoleOutput->section();
		}

		$this->pageSection->overwrite('Country: ' . $countryCode . ' Page #' . $page . ' loaded');
	}
}
