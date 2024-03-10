<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Console.Wishboxcdek
 * @copyright   (C) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Console\Wishboxcdek\Extension;

use Exception;
use Joomla\Application\ApplicationEvents;
use Joomla\CMS\Application\ConsoleApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdatecitiesCommand;
use Joomla\Plugin\Console\Wishboxcdek\Console\UpdateofficesCommand;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class Wishboxcdek extends CMSPlugin
{
	/**
	 * @var ConsoleApplication $app CMSApplication
	 *
	 * @since 1.0.0
	 */
	protected $app;

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

		if (!$this->app->isClient('cli'))
		{
			return;
		}

		$this->registerCLICommands();
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
		$app = Factory::getApplication();

		if ($app->isClient('cli'))
		{
			return [
				ApplicationEvents::BEFORE_EXECUTE => 'registerCLICommands',
			];
		}

		return [];
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function registerCLICommands(): void
	{
		$updateCitiesCommand = new UpdatecitiesCommand;
		$this->app->addCommand($updateCitiesCommand);

		$updateOfficesCommand = new UpdateofficesCommand;
		$this->app->addCommand($updateOfficesCommand);
	}
}
