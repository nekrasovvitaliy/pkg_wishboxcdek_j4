<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Controller;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\Component\Wishboxcdek\Site\Model\Offices\UpdaterModel as OfficesUpdaterModel;
use WishboxCdekSDK2\ApiClientException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Offices controller class.
 *
 * @since  1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficesController extends AdminController
{
	/**
	 * Method to toggle the featured setting of a list of articles.
	 *
	 * @return  void
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 */
	public function update(): void
	{
		$app = Factory::getApplication();

		/** @var OfficesUpdaterModel $officesupdaterModel */
		$officesupdaterModel = $app->bootComponent('com_wishboxcdek')
			->createModel(
				'updater',
				'Site\\Model\\Offices',
				['ignore_request' => true]
			);

		try
		{
			if (!$officesupdaterModel->update())
			{
				// Throw new Exception
				throw new Exception('Update return false', 500);
			}
		}
		catch (ApiClientException $e)
		{
			$this->setRedirect(
				Route::_('index.php?option=com_wishboxcdek', false),
				$e->getMessage()
			);

			return;
		}

		$this->setRedirect(
			Route::_('index.php?option=com_wishboxcdek', false),
			Text::_('COM_WISHBOXCDEK_MESSAGE_OFFICES_SUCCESSFULLY_UPDATED')
		);
	}
}
