<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Console\Wishboxcdek\Extension;

use Exception;
use Joomla\Application\ApplicationEvents;
use Joomla\CMS\Application\ConsoleApplication;
use Joomla\CMS\Console\Loader\WritableLoaderInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Component\Wishboxcdek\Site\Event\Model\Cities\Updater\AfterLoadCitiesEvent;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\SubscriberInterface;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdatecitiesCommand;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdateofficesCommand;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdateOrderStatutesCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class Wishboxcdek extends CMSPlugin implements SubscriberInterface
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
			'onWishboxCdekCitiesUpdaterAfterLoadCities'     => 'onWishboxCdekCitiesUpdaterAfterLoadCities'
		];
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function registerCommands(): void
	{
		$commands = [
			UpdatecitiesCommand::class,
			UpdateofficesCommand::class,
			UpdateOrderStatutesCommand::class
		];

		foreach ($commands as $commandClass)
		{
			Factory::getContainer()->share(
				$commandClass,
				function (ContainerInterface $container) use ($commandClass) {
					return (new $commandClass)
						->setMVCFactory($this->getMVCFactory());
				},
				true
			);
			/** @noinspection PhpUndefinedMethodInspection */
			Factory::getContainer()->get(WritableLoaderInterface::class)
				->add($commandClass::getDefaultName(), $commandClass);
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
}
