<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wishboxcdek\Api\Controller;

use Exception;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\ApiController;
use Joomla\Component\Wishboxcdek\Site\Model\WebhookModel;
use RuntimeException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 */
class WebhookController extends ApiController
{
	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 *
	 * @since  1.0
	 */
	protected $default_view = 'webhook'; // phpcs:ignore

	/**
	 * @return  static  A \JControllerLegacy object to support chaining.
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function handleOrderStatus(): static
	{
		/** @var  WebhookModel $model */
		$model = $this->getModel('webhook', 'Site');

		if (!$model)
		{
			throw new RuntimeException(Text::_('JLIB_APPLICATION_ERROR_MODEL_CREATE'));
		}

		$data = $this->input->get('data', json_decode($this->input->json->getRaw(), true), 'array');
		$model->handleOrderStatus($data);

		return $this;
	}
}
