<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Console\WishboxCdek\Console\Command;

use Exception;
use Joomla\Console\Command\AbstractCommand;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use WishboxCdekLibrary\Service\City\CitiesUpdaterService;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class UpdateCitiesCommand extends AbstractCommand implements CdekClientAwareInterface, DatabaseAwareInterface
{
	use CdekClientAwareTrait;
	use DatabaseAwareTrait;

	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected static $defaultName = 'wishboxcdek:update-cities';

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
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	protected function configure(): void
	{
		$help = "<info>%command.name%</info> Updates cities
                        \nUsage: <info>php %command.full_name%</info>";

		$this->setDescription('Update cities');
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
	 *
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

		$citiesUpdater = new CitiesUpdaterService(
			$this->getDatabase(),
			$this->getCdekClient()
		);

		if (!$citiesUpdater->update(5000))
		{
			throw new Exception('Update return false', 500);
		}

		return  Command::SUCCESS;
	}
}
