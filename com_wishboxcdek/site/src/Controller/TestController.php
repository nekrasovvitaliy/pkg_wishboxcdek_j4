<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Error;
use Exception;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\Component\Wishboxcdek\Site\Model\Cities\UpdaterModel as CitiesUpdaterModel;
use Joomla\Component\Wishboxcdek\Site\Model\Offices\UpdaterModel as OfficesUpdaterModel;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class TestController extends BaseController
{
	/**
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function updateCities(): void
	{
		try
		{
			// If failed to set the memory limit
			if (!ini_set('memory_limit', '256000000'))
			{
				throw new Exception('ini_set("memory_limit", "512MB") return false', 500);
			}

			/** @var CitiesUpdaterModel $citiesupdaterModel */
			$citiesupdaterModel = $this->app->bootComponent('com_wishboxcdek')
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

			die;
		}
		catch (Exception | Error $e)
		{
			echo $e;

			die;
		}
	}

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function updateoffices(): void
	{
		try
		{
			/** @var OfficesUpdaterModel  $officesupdaterModel */
			$officesupdaterModel = $this->app->bootComponent('com_wishboxcdek')
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
			echo $e;

			die;
		}

		die;
	}
}
