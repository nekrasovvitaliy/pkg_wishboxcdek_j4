<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later;
 */

namespace Joomla\Component\WishboxCdek\Administrator\Controller;

use Exception;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareInterface;
use WishboxCdekLibrary\Service\Office\OfficesUpdaterServiceAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Offices controller class.
 *
 * @since        1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficesController extends AdminController implements OfficesUpdaterServiceAwareInterface
{
	use OfficesUpdaterServiceAwareTrait;

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
		$officesUpdater = $this->getOfficesUpdaterService();

		try
		{
			if (!$officesUpdater->update())
			{
				// Throw new Exception
				throw new Exception('Update return false', 500);
			}
		}
		catch (Exception $e)
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
