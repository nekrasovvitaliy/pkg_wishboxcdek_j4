<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\WishboxCdek\Api\Controller;

use Exception;
use Joomla\CMS\MVC\Controller\ApiController;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareInterface;
use WishboxCdekLibrary\Service\Webhook\WebhookServiceAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 */
class WebhookController extends ApiController implements WebhookServiceAwareInterface
{
	use WebhookServiceAwareTrait;

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
		$data = $this->input->get('data', json_decode($this->input->json->getRaw(), true), 'array');

		$this->getWebhookService()->handleOrderStatus($data);

		return $this;
	}
}
