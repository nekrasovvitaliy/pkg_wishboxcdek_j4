<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Exception;
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
	 * @since 1.0.0
	 */
	public function autocomplete(): void
	{
		try
		{
			$nameStartswith = $this->app->input->getVar('name_startsWith', '');
			$nameStartswith = trim($nameStartswith);

			/** @var CitiesModel $citiesModel */
			$citiesModel = $this->app->bootComponent('com_wishboxcdek')
				->createModel(
					'cities',
					'Site\\Model',
					['ignore_request' => true]
				);

			$data = $citiesModel->getCitiesDataForAutocomplete($nameStartswith);

			$this->app->mimeType = 'application/json';
			$this->app->setHeader('Content-Type', $this->app->mimeType . '; charset=' . $this->app->charSet);
			$this->app->sendHeaders();
			echo new JsonResponse($data);
			$this->app->close();
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

	/**
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function searchAjax(): void
	{
		try
		{
			$like = $this->app->input->getVar('like', '');
			$like = trim($like);

			/** @var CitiesModel $citiesModel */
			$citiesModel = $this->app->bootComponent('com_wishboxcdek')
				->createModel(
					'cities',
					'Site\\Model',
					['ignore_request' => true]
				);

			$data = $citiesModel->getCitiesDataForAjaxSearch($like);

			$this->app->mimeType = 'application/json';
			$this->app->setHeader('Content-Type', $this->app->mimeType . '; charset=' . $this->app->charSet);
			$this->app->sendHeaders();
			echo json_encode($data);
			$this->app->close();
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
