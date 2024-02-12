<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Controller;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Response\JsonResponse;
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Model\CartModel;
use Joomla\Component\Jshopping\Site\Model\Wishbox\Cdek\OfficesModel;
use Wishbox\JShopping\Controller\Base;

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
class ChangeofficeController extends Base
{
	/**
	 * Method display
	 *
	 * @param   boolean  $cachable   Cashable
	 * @param   array    $urlparams  Url params
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function display($cachable = false, $urlparams = [])
	{
		$shPrMethodId = $this->app->input->getInt('sh_pr_method_id', 0);

		/** @var CartModel $cart */
		$cart = JSFactory::getModel('cart', 'Site')->init('cart', 1);

		if (!count($cart->products))
		{
			$this->app->enqueueMessage(_JSHOP_ADDON_WISHBOXCDEK_MESSAGE_CART_IS_EMPTY, 'warning');

			return;
		}

		// Код города получателя
		$receiverCityCode = (int) $this->advUser->sm_wishboxcdek_city_code;

		// Если нет id города
		if ($receiverCityCode <= 0)
		{
			$this->app->enqueueMessage(_JSHOP_ADDON_WISHBOXCDEK_MESSAGE_RECIPIENT_CITY_NOT_SPECIFIED, 'warning');

			return;
		}

		// Получаем макет
		$layout = $this->app->input->getVar('layout', 'default');

		/** @var OfficesModel $wishboxcdekofficesModel */
		$wishboxcdekofficesModel = \JSFactory::getModel('offices', 'Site\\Wishbox\\Cdek');

		$offices = $wishboxcdekofficesModel->getOffices($receiverCityCode);

		foreach ($offices as $k => $office)
		{
			if (!empty($offices[$k]->neareststatin))
			{
				$offices[$k]->neareststation = trim($offices[$k]->neareststation);
			}
		}

		/** @var WishboxcdekcityTable $wishboxcdekcityTable */
		$wishboxcdekcityTable = \JSFactory::getTable('wishboxcdekcity');
		$wishboxcdekcityTable->load(['code' => $receiverCityCode]);

		$center = [$wishboxcdekcityTable->latitude, $wishboxcdekcityTable->longitude];

		$wishboxshipingcalculatorcdekModel = JSFactory::getModel('cdek', 'Site\\Wishbox\\Shippingcalculator');

		$shippingTariff = $wishboxshipingcalculatorcdekModel->getTariff($shPrMethodId);
		$shippingParams = $cart->getShippingParams();
		$selectedOfficeCode = (is_array($shippingParams) && isset($shippingParams['office'])) ? $shippingParams['office'] : null;

		$view = $this->getView('wishboxcdekchangeoffice');
		$view->addTemplatePath(JPATH_SITE . '/components/com_jshopping/tmpl/wishboxcdekchangeoffice');
		$view->setLayout($layout);
		$view->set('sh_pr_method_id', $shPrMethodId);
		$view->set('offices', $offices);
		$view->set('city_code', $receiverCityCode);
		$view->set('center', $center);
		$view->set('shipping_tariff', $shippingTariff);
		$view->set('selected_office_code', $selectedOfficeCode);
		$this->app->triggerEvent('onBeforeDisplayWishBoxCdekOfficesView', [&$view]);
		$view->display();
	}

	/**
	 * Method display office
	 *
	 * @param   boolean  $cachable   Cashable
	 * @param   array    $urlparams  Url params
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function displayOffice(bool $cachable = false, array $urlparams = []): void
	{
		// Получаем id офиса
		$id = $this->app->input->getVar('id', 0);

		// Если нет id офиса
		if ($id <= 0)
		{
			throw new InvalidArgumentException('id param must be greater than zero', 500);
		}

		$shPrMethodId = $this->app->input->getInt('sh_pr_method_id', 0);

		/** @var CartModel $cart */
		$cart = JSFactory::getModel('cart', 'Site')->init('cart', 1);

		if (!count($cart->products))
		{
			$this->app->enqueueMessage(_JSHOP_ADDON_WISHBOXCDEK_MESSAGE_CART_IS_EMPTY, 'notice');

			return;
		}

		$layout = $this->app->input->getVar('office_layout', 'office_default');

		/** @var WishboxcdekofficeTable $wishboxcdekofficeTable */
		$wishboxcdekofficeTable = JSFactory::getTable('wishboxcdekoffice');
		$wishboxcdekofficeTable->load($id);

		$wishboxshippingcalculatorcdekModel = JSFactory::getModel('cdek', 'Site\\Wishbox\\Shippingcalculator');

		$shippingTariff = $wishboxshippingcalculatorcdekModel->getTariff($shPrMethodId);
		$view = $this->getView(
			'wishboxcdekchangeoffice',
			$this->app->getDocument()->getType(),
			'',
			[
				'base_path' => $this->basePath,
				'layout' => $layout
			]
		);
		$view->set('sh_pr_method_id', $shPrMethodId);
		$view->set('office', $wishboxcdekofficeTable);
		$view->set('shipping_tariff', $shippingTariff);
		$this->app->triggerEvent('onBeforeDisplayWishBoxCdekOfficeView', [&$view]);
		$view->display();
	}

	/**
	 * Method outputs JSON with offices on a map.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getoffices(): void
	{
		try
		{
			$cityCode = $this->app->input->getInt('city_code', 0);

			if (!$cityCode)
			{
				throw new InvalidArgumentException('city_code param must be greater than zero', 500);
			}

			$shPrMethodId = $this->app->input->getInt('sh_pr_method_id', 0);

			if ($shPrMethodId <= 0)
			{
				throw new InvalidArgumentException('sh_pr_method_id param must be greater than zero', 500);
			}

			/** @var OfficesModel $wishboxcdekofficesModel */
			$wishboxcdekofficesModel = JSFactory::getModel('offices', 'Site\\Wishbox\\Cdek');
			$data = $wishboxcdekofficesModel->getOfficesDataForMap($cityCode, $shPrMethodId);
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
}
