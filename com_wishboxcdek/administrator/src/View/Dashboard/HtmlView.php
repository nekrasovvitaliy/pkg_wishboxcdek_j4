<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\View\Dashboard;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Wishboxcdek\Administrator\Helper\WishboxcdekHelper;
use Joomla\Component\Wishboxcdek\Administrator\Model\DashboardModel;

/**
 * View class for a dashboard.
 *
 * @since  1.0.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function display($tpl = null)
	{
		$this->addToolbar();
		$this->sidebar = Sidebar::render();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function addToolbar(): void
	{
		$app = Factory::getApplication();
		$document = $this->getDocument();

		/** @var Toolbar $toolbar */
		$toolbar = $document->getToolbar();

		$canDo = WishboxcdekHelper::getActions();
		$option = strtolower($app->getInput()->get('option', ''));
		ToolbarHelper::title(Text::_(mb_strtoupper($option)), 'generic');

		/** @var DashboardModel $model */
		$model = $this->getModel();

		$citiesCount = $model->getCitiesCount();
		$officesCount = $model->getOfficesCount();

		$toolbar->standardButton(
			'cities-update',
			Text::_('COM_WISHBOXCDEK_TOOLBAR_UPDATE_CITIES') . '(' . $citiesCount . ')',
			'cities.update'
		)
			->icon('icon-refresh')
			->listCheck(false);

		$toolbar->standardButton(
			'offices-update',
			Text::_('COM_WISHBOXCDEK_TOOLBAR_UPDATE_OFFICES') . '(' . $officesCount . ')',
			'offices.update'
		)
			->icon('icon-refresh')
			->listCheck(false);

		$toolbar->standardButton(
			'orders-updatestatuses',
			'COM_WISHBOXCDEK_TOOLBAR_UPDATE_ORDER_STATUSES',
			'orders.updatestatuses'
		)
			->icon('icon-refresh')
			->listCheck(false);

		if ($canDo->get('core.admin'))
		{
			ToolbarHelper::preferences($option);
		}

		// Set sidebar action
		Sidebar::setAction('index.php?option=' . $option . '&view=' . $this->getName());
	}
}
