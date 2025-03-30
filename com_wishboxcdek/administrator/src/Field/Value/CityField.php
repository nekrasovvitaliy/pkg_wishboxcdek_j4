<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field\Value;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\Component\Wishboxcdek\Administrator\Table\CityTable;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class CityField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'value_city';

	/**
	 * Name of the layout being used to render the field
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $layout = 'components.wishboxcdek.field.valuecity';

	/**
	 * Method to get the data to be passed to the layout for rendering.
	 *
	 * @return  array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function getLayoutData(): array
	{
		$layoutData = parent::getLayoutData();

		$layoutData['cityTable'] = $this->getCityTable();

		return $layoutData;
	}

	/**
	 * @return CityTable
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function getCityTable(): CityTable
	{
		$app = Factory::getApplication();

		$cityCode = $this->value;

		/** @var CityTable $cityTable */
		$cityTable = $app->bootComponent('com_wishboxcdek')
			->getMVCFactory()
			->createTable('City', 'Administrator');
		$cityTable->load(['code' => $cityCode]);

		return $cityTable;
	}
}
