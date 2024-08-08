<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
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
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdatecitiesCommand;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdateofficesCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use WishboxCdekSDK2\Model\Response\Location\CitiesGet\CityResponse;

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
	 * @param   DispatcherInterface  $subject  The object to observe
	 * @param   array                $config   An optional associative array of configuration settings.
	 *                                           Recognized key values include 'name', 'group', 'params', 'language'
	 *                                           (this list is not meant to be comprehensive).
	 *
	 * @since 1.0.0
	 */
	public function __construct(&$subject, $config = [])
	{
		parent::__construct($subject, $config);
	}

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
			ApplicationEvents::BEFORE_EXECUTE   => 'registerCommands',
			'onAfterLoadWishboxCdekCities'      => 'onAfterLoadWishboxCdekCities'
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
		// Test command
		Factory::getContainer()->share(
			'wishboxcdek.updateCities',
			function (ContainerInterface $container) {
				return new UpdatecitiesCommand;
			},
			true
		);

		// Add test command to joomla.php cli script
		Factory::getContainer()->get(WritableLoaderInterface::class)
			->add('wishboxcdek:update-cities', 'wishboxcdek.updateCities');

		// Second test command
		Factory::getContainer()->share(
			'wishboxcdek.updateOffices',
			function (ContainerInterface $container) {
				return new UpdateofficesCommand;
			},
			true
		);

		// Add second test command to joomla.php cli script
		Factory::getContainer()->get(WritableLoaderInterface::class)
			->add('wishboxcdek:update-offices', 'wishboxcdek.updateOffices');
	}

	/**
	 * @param   Event  $event  Event
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onAfterLoadWishboxCdekCities(Event $event): void
	{
		/** @var CityResponse[] $cityResponses */
		$cityResponses = $event->getArgument(0);

		/** @var integer $page Page */
		$page = $event->getArgument(1);

		/** @var integer $limit Limit */
		$limit = $event->getArgument(2);

		/** @var ConsoleApplication $app */
		$app = Factory::getApplication();

		if (!$this->pageSection)
		{
			$consoleOutput = $app->getConsoleOutput();
			$this->pageSection = $consoleOutput->section();
		}

		$this->pageSection->overwrite('Page ' . $page . ' loaded');

		$event->setArgument(0, $cityResponses);
		$event->setArgument(1, $page);
		$event->setArgument(2, $limit);
	}
}
