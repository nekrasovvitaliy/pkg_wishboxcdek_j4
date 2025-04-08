<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
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
 * Constructor for change office in a modal window
 *
 * @property mixed $advUser
 *
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class ChangeofficeController extends BaseController
{
	/**
	 * Method outputs JSON with offices on a map.
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getoffices(): void
	{
		$app = Factory::getApplication();

		try
		{
			$cityCode = $this->input->getInt('city_code', 0);

			if (!$cityCode)
			{
				throw new InvalidArgumentException('city_code param must be greater than zero', 500);
			}

			$shPrMethodId = $this->input->getInt('shipping_method_id', 0);

			if ($shPrMethodId <= 0)
			{
				throw new InvalidArgumentException('sh_pr_method_id param must be greater than zero', 500);
			}

			/** @var OfficesModel $wishboxcdekofficesModel */
			$wishboxcdekofficesModel = JSFactory::getModel('offices', 'Site\\Wishbox\\Cdek');

			$data = $wishboxcdekofficesModel->getOfficesDataForMap($cityCode, $shPrMethodId);

			$app->mimeType = 'application/json';
			$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
			$app->sendHeaders();
			echo new JsonResponse($data);
			$app->close();
		}
		catch (Exception $e)
		{
			$this->app->mimeType = 'application/json';
			$this->app->setHeader('Content-Type', $this->app->mimeType . '; charset=' . $this->app->charSet);
			$this->app->sendHeaders();
			echo new JsonResponse($e);
			$this->app->close();
		}
	}
}
