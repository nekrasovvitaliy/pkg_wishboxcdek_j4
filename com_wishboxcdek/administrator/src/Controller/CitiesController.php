<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Controller;

use Exception;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\Component\Wishboxcdek\Site\Model\Cities\UpdaterModel as CitiesUpdaterModel;
use WishboxCdekSDK2\Exception\ApiException;
use WishboxCdekSDK2\Exception\ClientException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Cities controller class.
 *
 * @since  1.0.0
 *
 * @noinspection PhpUnused
 */
class CitiesController extends AdminController
{
	/**
	 * @return  void

	 * @throws Exception
	 *
	 * @since   1.0.0
	 */
	public function update(): void
	{
		/** @var CitiesupdaterModel $citiesUpdaterModel */
		$citiesUpdaterModel = $this->factory->createModel(
			'updater',
			'Site\\Model\\Cities',
			['ignore_request' => true]
		);

		try
		{
			if (!$citiesUpdaterModel->update(5000))
			{
				throw new Exception('Update return false', 500);
			}
		}
		catch (ApiException | ClientException $e)
		{
			$this->setRedirect(
				Route::_('index.php?option=com_wishboxcdek&view=dashboard', false),
				$e->getMessage()
			);

			return;
		}

		$this->setRedirect(
			Route::_('index.php?option=com_wishboxcdek&view=dashboard', false),
			Text::_('COM_WISHBOXCDEK_MESSAGE_CITIES_SUCCESSFULLY_UPDATED')
		);
	}
}
