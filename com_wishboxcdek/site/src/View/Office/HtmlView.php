<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\View\Office;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\User\User;
use Joomla\Component\Wishboxcdek\Site\Helper\WishboxcdekHelper;
use Joomla\Registry\Registry;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.5
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The page parameters
	 *
	 * @var    Registry|null
	 *
	 * @since  1.0.0
	 */
	protected ?Registry $params = null;

	/**
	 * The model state
	 *
	 * @var   CMSObject
	 *
	 * @since 1.0.0
	 */
	protected CMSObject $state;

	/**
	 * The user object
	 *
	 * @var   User|null
	 *
	 * @since 1.0.0
	 */
	protected ?User $user = null;

	/**
	 * The page class suffix
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected string $pageclass_sfx = ''; // phpcs:ignore

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function display($tpl = null)
	{
		$user = $this->getCurrentUser();

		$this->state            = $this->get('State');
		$this->item             = $this->get('Item');

		$this->shippingTariff = WishboxcdekHelper::getShippingTariff(
			$this->state->get('shopName'),
			$this->state->get('shippingMethodId'),
		);
		$this->user = $user;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		$this->params = $this->state->get('params');

		$this->prepareDocument();

		parent::display($tpl);
	}

	/**
	 * @return  void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function prepareDocument(): void
	{
		$app = Factory::getApplication();

		/**
		 * Because the application sets a default page title,
		 * we need to get it from the menu item itself
		 */
		$menu = $app->getMenu()->getActive();

		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', Text::_('JGLOBAL_ARTICLES'));
		}

		$title = $this->params->get('page_title', '');

		if (empty($title))
		{
			/**
			 * This happens when the current active menu item is linked to the article without browser
			 * page title set, so we use Browser Page Title in article and fallback to article title
			 * if that is not set
			 */
			$title = $this->item->params->get('article_page_title', $this->item->title);
		}

		$this->setDocumentTitle($title);
		$this->getDocument()->setDescription($this->params->get('menu-meta_description'));

		if ($this->params->get('robots'))
		{
			$this->getDocument()->setMetaData('robots', $this->params->get('robots'));
		}
	}
}
