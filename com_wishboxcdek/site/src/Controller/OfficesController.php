<?php
/**
 * @copyright  2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek\OfficesModel;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficesController extends BaseController
{
	/**
	 * Метод возвращает JSON с магазинами на карте
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getoffices(): void
	{
		$app = Factory::getApplication();

		try
		{
			$cityCode = $app->input->getInt('city_code', 0);

			if (!$cityCode)
			{
				throw new InvalidArgumentException('city_code param must not be 0', 500);
			}

			$shPrMethodId = $app->input->getInt('shipping_method_id', 0);

			$shopName = $app->input->get('shop_name', '');

			/** @var OfficesModel $officesModel */
			$officesModel = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createModel('Offices', 'Site');

			$data = $officesModel->getOfficesDataForMap($shopName, $cityCode, $shPrMethodId);
			$app->mimeType = 'application/json';
			$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
			$app->sendHeaders();
			echo new JsonResponse($data);
			$app->close();
		}
		catch (Exception $e)
		{
			$app->mimeType = 'application/json';
			$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
			$app->sendHeaders();
			echo new JsonResponse($e);
			$app->close();
		}
	}
}
