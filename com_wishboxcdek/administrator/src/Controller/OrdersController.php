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
use Joomla\Component\Wishboxcdek\Site\Model\OrderStatusUpdaterModel;
use WishboxCdekSDK2\Exception\ApiException;
use WishboxCdekSDK2\Exception\ClientException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Orders` controller class.
 *
 * @since  1.0.0
 *
 * @noinspection PhpUnused
 */
class OrdersController extends AdminController
{
	/**
	 * @return  void
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function updateStatuses(): void
	{
		$component = $this->input->get('component', '');
		$orderIds = $this->input->get('cid', []);
		$redirectUrl = $this->input->get('redirect_url', '', 'Raw');

		/** @var OrderStatusupdaterModel $orderStatusUpdaterModel */
		$orderStatusUpdaterModel = $this->factory->createModel(
			'OrderStatusUpdater',
			'Site\\Model',
			['ignore_request' => true]
		);

		try
		{
			$orderStatusUpdaterModel->update($component, $orderIds);
		}
		catch (ApiException | ClientException $e)
		{
			$this->setRedirect(
				Route::_('index.php?option=com_wishboxcdek&view=dashboard', false),
				$e->getMessage()
			);

			return;
		}

		if (empty($redirectUrl))
		{
			$redirectUrl = 'index.php?option=com_wishboxcdek&view=dashboard';
		}

		$this->setRedirect(
			Route::_($redirectUrl, false),
			Text::_('COM_WISHBOXCDEK_MESSAGE_ORDER_STATUSES_SUCCESSFULLY_UPDATED')
		);
	}
}
