<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\Component\Wishboxcdek\Site\Model\CitiesModel;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class CitiesController extends BaseController
{
	/**
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function autocomplete(): void
	{
		$app = Factory::getApplication();

		try
		{
			$nameStartswith = $this->input->getVar('name_startsWith', '');
			$nameStartswith = trim($nameStartswith);

			/** @var CitiesModel $citiesModel */
			$citiesModel = $this->factory->createModel(
				'cities',
				'Site\\Model',
				['ignore_request' => true]
			);

			$data = $citiesModel->getCitiesDataForAutocomplete($nameStartswith);

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

	/**
	 * @return void
	 *
	 * @throws Exception
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function searchAjax(): void
	{
		$app = Factory::getApplication();

		try
		{
			$like = $this->input->getVar('like', '');
			$like = trim($like);

			/** @var CitiesModel $citiesModel */
			$citiesModel = $this->factory->createModel(
				'cities',
				'Site\\Model',
				['ignore_request' => true]
			);

			$data = $citiesModel->getCitiesDataForAjaxSearch($like);

			$app->mimeType = 'application/json';
			$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
			$app->sendHeaders();
			echo json_encode($data);
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
