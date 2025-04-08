<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

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
			$cityCode = $this->input->getInt('city_code', 0);

			if (!$cityCode)
			{
				throw new InvalidArgumentException('city_code param must not be 0', 500);
			}

			$shPrMethodId = $this->input->getInt('shipping_method_id', 0);

			$shopName = $this->input->get('shop_name', '');

			/** @var OfficesModel $officesModel */
			$officesModel = $this->factory->createModel('Offices', 'Site');

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
