<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\ApiAuthentication\Wishboxcdek\Extension;

use Exception;
use Joomla\CMS\Authentication\Authentication;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Event\User\AuthenticationEvent;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\User\UserFactoryAwareTrait;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\SubscriberInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\Utilities\IpHelper;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class Wishboxcdek extends CMSPlugin implements SubscriberInterface
{
	use DatabaseAwareTrait;
	use UserFactoryAwareTrait;

	/**
	 * @return string[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onUserAuthenticate' => 'onUserAuthenticate',
		];
	}

	/**
	 * This method should handle any authentication and report back to the subject
	 *
	 * @param   AuthenticationEvent  $event    Authentication event
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onUserAuthenticate(AuthenticationEvent $event): void
	{
		$response = $event->getAuthenticationResponse();

		$app = $this->getApplication();

		// Default response is authentication failure.
		$response->type          = 'Wishboxcdek';
		$response->status        = Authentication::STATUS_FAILURE;
		$response->error_message = $this->getApplication()->getLanguage()->_('JGLOBAL_AUTH_FAIL'); // phpcs:ignore

		$ip = IpHelper::getIp();

		$componentParams = ComponentHelper::getParams('com_wishboxcdek');
		$ipAddresses = (array) $componentParams->get('ip_addresses');
		$ipAddresses = ArrayHelper::getColumn($ipAddresses, 'ip_address');

		if (!in_array($ip, $ipAddresses))
		{
			return;
		}

		$userId = $componentParams->get('user_id', 0);

		// Get the actual user record
		$user = $this->getUserFactory()->loadUserById($userId);

		// Disallow login for blocked, inactive or password reset required users
		if ($user->block || !empty(trim($user->activation)) || $user->requireReset)
		{
			$response->status = Authentication::STATUS_DENIED;

			return;
		}

		// Update the response to indicate successful login
		$response->status        = Authentication::STATUS_SUCCESS;
		$response->error_message = ''; // phpcs:ignore
		$response->username      = $user->username;
		$response->email         = $user->email;
		$response->fullname      = $user->name;
		$response->timezone      = $user->getParam('timezone', $app->get('offset', 'UTC'));
		$response->language      = $user->getParam('language', $app->get('language'));

		// Stop event propagation when status is STATUS_SUCCESS
		$event->stopPropagation();
	}
}
