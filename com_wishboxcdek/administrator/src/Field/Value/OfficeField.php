<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field\Value;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\Component\Wishboxcdek\Administrator\Table\OfficeTable;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficeField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'value_office';

	/**
	 * Name of the layout being used to render the field
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $layout = 'components.wishboxcdek.field.valueoffice';

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

		$layoutData['officeTable'] = $this->getOfficeTable();

		return $layoutData;
	}

	/**
	 * @return OfficeTable
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function getOfficeTable(): OfficeTable
	{
		$app = Factory::getApplication();

		$officeCode = $this->value;

		/** @var OfficeTable $officeTable */
		$officeTable = $app->bootComponent('com_wishboxcdek')
			->getMVCFactory()
			->createTable('Office', 'Administrator');
		$officeTable->load(['code' => $officeCode]);

		return $officeTable;
	}
}
