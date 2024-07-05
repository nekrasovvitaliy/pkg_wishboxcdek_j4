<?php
/**
 * @copyright  (c) 2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Wishboxcdek\Administrator\Table\CityTable;
use Joomla\Database\ParameterType;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficeModel extends BaseDatabaseModel
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
		$pk = $app->getInput()->getInt('id');
		$this->setState('office.id', $pk);

		// Load state from the request.
		$cityCode = $app->getInput()->getInt('cityCode');
		$this->setState('cityCode', $cityCode);

		$shippingMethodId = $app->getInput()->getInt('shippingMethodId');
		$this->setState('shippingMethodId', $shippingMethodId);

		$shopName = $app->getInput()->get('shopName');
		$this->setState('shopName', $shopName);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Method to get article data.
	 *
	 * @param   integer  $pk  The id of the article.
	 *
	 * @return  object|boolean  Menu item data object on success, boolean false
	 */
	public function getItem($pk = null)
	{
		$pk = (int) ($pk ?: $this->getState('office.id'));

		if ($this->_item === null)
		{
			$this->_item = [];
		}

		if (!isset($this->_item[$pk]))
		{
			try
			{
				$db    = $this->getDatabase();
				$query = $db->getQuery(true);

				$query->select(
					$this->getState(
						'item.select',
						[
							'a.*',
						]
					)
				)
					->from($db->quoteName('#__wishboxcdek_offices', 'a'))
					->where(
						[
							'a.id = :pk',
						]
					)
					->bind(':pk', $pk, ParameterType::INTEGER);

				$db->setQuery($query);
				$data = $db->loadObject();

				if (empty($data))
				{
					throw new \Exception(Text::_('COM_CONTENT_ERROR_ARTICLE_NOT_FOUND'), 404);
				}

				$this->_item[$pk] = $data;
			}
			catch (\Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go through the error handler to allow Redirect to work.
					throw $e;
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
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
	public function getShippingTariff(?int $cityCode = null): int
	{
		$shopName = $this->getState('shopName');

		return 1;
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
