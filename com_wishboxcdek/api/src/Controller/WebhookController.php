<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wishboxcdek\Api\Controller;

use Exception;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\ApiController;
use Joomla\CMS\User\UserFactoryAwareInterface;
use Joomla\CMS\User\UserFactoryAwareTrait;
use Joomla\Component\Wishboxcdek\Site\Model\WebhooksModel;
use RuntimeException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 */
class WebhookController extends ApiController implements UserFactoryAwareInterface
{
	use UserFactoryAwareTrait;

	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 *
	 * @since  1.0
	 */
	protected $default_view = 'contacts';

	/**
	 * @return  static  A \JControllerLegacy object to support chaining.
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 */
	public function handle()
	{
		/** @var  WebhooksModel $model */
		$model = $this->getModel('webhooks', 'Site');

		if (!$model)
		{
			throw new RuntimeException(Text::_('JLIB_APPLICATION_ERROR_MODEL_CREATE'));
		}

		$data = $this->input->get('data', json_decode($this->input->json->getRaw(), true), 'array');
		$model->orderStatus($data);

		return $this;
	}
}
