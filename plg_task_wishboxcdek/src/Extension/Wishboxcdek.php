<?php
/**
 * @copyright   (C) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Task\Wishboxcdek\Extension;

use Error;
use Exception;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Component\Wishboxcdek\Site\Model\Cities\UpdaterModel as CitiesUpdaterModel;
use Joomla\Component\Wishboxcdek\Site\Model\Offices\UpdaterModel as OfficesUpdaterModel;
use Joomla\Component\Scheduler\Administrator\Event\ExecuteTaskEvent;
use Joomla\Component\Scheduler\Administrator\Task\Status;
use Joomla\Component\Scheduler\Administrator\Traits\TaskPluginTrait;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\SubscriberInterface;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Task plugin with routines to update quantity from retailCRM. These routines can be used to control planned
 * maintenance periods and related operations.
 *
 * @since  1.0.0
 */
final class Wishboxcdek extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;
	use TaskPluginTrait;

	/**
	 * @var string[]
	 *
	 * @since 1.0.0
	 */
	protected const TASKS_MAP = [
		'plg_task_wishboxcdek_update_offices' =>
		[
			'langConstPrefix' => 'PLG_TASK_WISHBOXCDEK_UPDATE_OFFICES',
			'method'          => 'updateOffices'
		],
		'plg_task_wishboxcdek_update_cities' =>
		[
			'langConstPrefix' => 'PLG_TASK_WISHBOXCDEK_UPDATE_CITIES',
			'form'            => 'update_cities',
			'method'          => 'updateCities'
		],
		'plg_task_wishboxcdek_update_webhooks' =>
			[
				'langConstPrefix' => 'PLG_TASK_WISHBOXCDEK_UPDATE_WEBHOOKS',
				'form'            => 'update_webhooks',
				'method'          => 'updateWebhooks'
			]
	];

	/**
	 * @var boolean Autoload the language file
	 *
	 * @since 1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * @return string[]
	 *
	 * @since 1.0.0
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onTaskOptionsList'    => 'advertiseRoutines',
			'onExecuteTask'        => 'standardRoutineHandler',
			'onContentPrepareForm' => 'enhanceTaskItemForm',
		];
	}

	/**
	 * Constructor.
	 *
	 * @param   DispatcherInterface  $dispatcher  The dispatcher
	 * @param   array                $config      An optional associative array of configuration settings
	 *
	 * @since   1.0.0
	 */
	public function __construct(DispatcherInterface $dispatcher, array $config)
	{
		parent::__construct($dispatcher, $config);
	}

	/**
	 * @param   ExecuteTaskEvent  $event Event
	 *
	 * @return integer
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnusedPrivateMethodInspection
	 * @noinspection PhpUnusedParameterInspection
	 */
	private function updateOffices(ExecuteTaskEvent $event): int
	{
		try
		{
			/** @var OfficesUpdaterModel $officesupdaterModel */
			$officesupdaterModel = $this->getMVCFactory()
				->createModel(
					'updater',
					'Site\\Model\\Offices',
					['ignore_request' => true]
				);

			if (!$officesupdaterModel->update())
			{
				throw new Exception('update return false', 500);
			}
		}
		catch (Exception | Error $e)
		{
			$this->logTask((string) $e, 'error');

			return Status::KNOCKOUT;
		}

		return Status::OK;
	}

	/**
	 * @param   ExecuteTaskEvent  $event  Event
	 *
	 * @return integer
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 * @noinspection PhpUnusedPrivateMethodInspection
	 */
	private function updateCities(ExecuteTaskEvent $event): int
	{
		try
		{
			$params = $event->getArgument('params');

			if (!ini_set('memory_limit', '256000000'))
			{
				throw new Exception('ini_set("memory_limit", "512MB") return false', 500);
			}

			$limit = $params->limit;

			/** @var CitiesUpdaterModel $citiesupdaterModel */
			$citiesupdaterModel = $this->getMVCFactory()
				->createModel(
					'updater',
					'Site\\Model\\Cities',
					['ignore_request' => true]
				);

			if (!$citiesupdaterModel->update(5000))
			{
				// Throw new Exception
				throw new Exception('update return false', 500);
			}
		}
		catch (Exception | Error $e)
		{
			$this->logTask((string) $e, 'error');

			return Status::KNOCKOUT;
		}

		return Status::OK;
	}
}
