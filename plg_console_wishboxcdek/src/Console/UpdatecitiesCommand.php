<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Console.Wishboxcdek
 * @copyright   (C) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Console\Wishboxcdek\Console;

use Exception;
use Joomla\CMS\Factory;
use Joomla\Component\Wishboxcdek\Site\Model\Cities\UpdaterModel as CitiesUpdaterModel;
use Joomla\Console\Command\AbstractCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class UpdatecitiesCommand extends AbstractCommand
{
	/**
	 * Имя команды по умолчанию
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected static $defaultName = 'wishboxcdek:updateCities';

	/**
	 * @var InputInterface
	 *
	 * @since 1.0.0
	 */
	private InputInterface $cliInput;

	/**
	 * SymfonyStyle Object
	 *
	 * @var SymfonyStyle
	 *
	 * @since 1.0.0
	 */
	private SymfonyStyle $ioStyle;

	/**
	 * Создание команды.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Конфигурирует вход-выход
	 *
	 * @param   InputInterface   $input   Консольный ввод
	 * @param   OutputInterface  $output  Консольный вывод
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 */
	private function configureIO(InputInterface $input, OutputInterface $output): void
	{
		$this->cliInput = $input;
		$this->ioStyle = new SymfonyStyle($input, $output);
	}

	/**
	 * Инициализация команды.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	protected function configure(): void
	{
		$help = "<info>%command.name%</info> Updates cities
                        \nUsage: <info>php %command.full_name%</info>";

		$this->setDescription('Called by cron to updates cities.');
		$this->setHelp($help);

	}

	/**
	 * Внутренняя функция для выполнения команды.
	 *
	 * @param   InputInterface   $input   Входные данные для введения в команду.
	 * @param   OutputInterface  $output  Вывод для вставки в команду.
	 *
	 * @return  integer  Код возврата команды
	 *
	 * @throws Exception
	 * @since   1.0.0
	 */
	protected function doExecute(InputInterface $input, OutputInterface $output): int
	{
		$this->configureIO($input, $output);

		$this->ioStyle->title('Updating cities');

		if (!ini_set('memory_limit', '256000000'))
		{
			throw new Exception('ini_set("memory_limit", "512MB") return false', 500);
		}

		$app = Factory::getApplication();

		/** @var CitiesUpdaterModel $citiesupdaterModel */
		$citiesupdaterModel = $app->bootComponent('com_wishboxcdek')
			->createModel(
				'updater',
				'Site\\Model\\Cities',
				['ignore_request' => true]
			);

		if (!$citiesupdaterModel->update(5000))
		{
			// Throw new Exception
			throw new Exception('Update return false', 500);
		}

		return  Command::SUCCESS;
	}
}
