<?php
/**
 * @copyright  (c) 2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Wishboxcdek\Administrator\Table\CityTable;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 *
 * @noinspection PhpUnused
 */
class ChangeofficeModel extends BaseDatabaseModel
{
	/**
	 * Method to autopopulate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	protected function populateState()
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$cityCode = $app->getInput()->getInt('city_code');
		$this->setState('cityCode', $cityCode);

		$shopName = $app->getInput()->get('shop_name');
		$this->setState('shopName', $shopName);

		$shippingMethodId = $app->getInput()->getInt('shipping_method_id');
		$this->setState('shippingMethodId', $shippingMethodId);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * @param   integer|null  $cityCode  City code
	 *
	 * @return  integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCount(?int $cityCode = null): int
	{
		$cityCode = (int) ($cityCode ?: $this->getState('cityCode'));

		return 1;
	}

	/**
	 * @param   integer|null  $cityCode  City code
	 *
	 * @return  float[]
	 *
	 * @throws Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getCenter(?int $cityCode = null): array
	{
		$app = Factory::getApplication();

		$cityCode = (int) ($cityCode ?: $this->getState('cityCode'));

		if (!$cityCode)
		{
			throw new Exception('citycode must be more than zero');
		}

		/** @var CityTable $wishboxcdekcityTable */
		$wishboxcdekcityTable = $app->bootComponent('com_wishboxcdek')
			->getMVCFactory()
			->createTable('city', 'Administrator');

		if (!$wishboxcdekcityTable->load(['code' => $cityCode]))
		{
			throw new Exception('City not found', 500);
		}

		return [$wishboxcdekcityTable->latitude, $wishboxcdekcityTable->longitude];
	}
}
