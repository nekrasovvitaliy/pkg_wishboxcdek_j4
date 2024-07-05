<?php
/**
 * @copyright  (c) 2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\View\Offices;

use Exception;
use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\User\User;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.5
 */
class JsonView extends BaseJsonView
{
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
		$this->state            = $this->get('State');
		$this->_output          = $this->get('MapData');
		echo json_encode($this->_output);

		parent::display($tpl);
	}
}
