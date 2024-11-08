<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Wishboxcdek\Tariff\Extension;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Component\Wishboxcdek\Administrator\Table\TariffTable;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use WishboxCdekSDK2\Model\Response\Calculator\TariffListPostResponse;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 */
class Tariff extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;
	use DatabaseAwareTrait;

	/**
	 * @param   DispatcherInterface  $subject  The object to observe
	 * @param   array                $config   An optional associative array of configuration settings.
	 *                                           Recognized key values include 'name', 'group', 'params', 'language'
	 *                                           (this list is not meant to be comprehensive).
	 *
	 * @since 1.0.0
	 */
	public function __construct(&$subject, $config = [])
	{
		parent::__construct($subject, $config);
	}

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
			'onWishboxCdekClientV2AfterCalculateTariffList'     => 'onWishboxCdekClientV2AfterCalculateTariffList'
		];
	}

	/**
	 * @param   Event  $event  Event
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function onWishboxCdekClientV2AfterCalculateTariffList(Event $event): void
	{
		/** @var TariffListPostResponse $response */
		$response = $event->getArgument('response');

		$app = Factory::getApplication();

		$tariffCodeResponses = $response->getTariffCodes();

		foreach ($tariffCodeResponses as $tariffCodeResponse)
		{
			/** @var TariffTable $tariffTable */
			$tariffTable = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createTable('Tariff');

			if (!$tariffTable->load(['code' => $tariffCodeResponse->getTariffCode()]))
			{
				$tariffTable->code = $tariffCodeResponse->getTariffCode();
				$tariffTable->published = 1;
				$tariffTable->name = $tariffCodeResponse->getTariffName();
				$tariffTable->mode = $tariffCodeResponse->getDeliveryMode();
				$tariffTable->weight_limit = ''; // phpcs:ignore
				$tariffTable->service = '';
				$tariffTable->description = $tariffCodeResponse->getTariffDescription();
				$tariffTable->store();

				if (!$tariffTable->store())
				{
					throw new Exception($tariffTable->getError(), 500);
				}
			}
		}
	}
}
