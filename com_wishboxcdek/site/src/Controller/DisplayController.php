<?php
/**
 * @copyright (c) 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Exception;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

/**
 * Display Component Controller
 *
 * @since  1.0.0
 */
class DisplayController extends BaseController
{
	/**
	 * Constructor.
	 *
	 * @param   array                     $config   An optional associative array of configuration settings.
	 *                                              Recognized key values include 'name', 'default_task', 'model_path', and
	 *                                              'view_path' (this list is not meant to be comprehensive).
	 * @param   MVCFactoryInterface|null  $factory  The factory.
	 * @param   null                      $app      The JApplication for the dispatcher
	 * @param   null                      $input    Input
	 *
	 * @since  1.0.0
	 */
	public function __construct($config = [], MVCFactoryInterface $factory = null, $app = null, $input = null)
	{
		parent::__construct($config, $factory, $app, $input);
	}

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link InputFilter::clean()}.
	 *
	 * @return  BaseController  This object to support chaining.
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$this->input->set('view', $this->input->get('view', 'dashboard'));

		parent::display($cachable, $urlparams);

		return $this;
	}
}
