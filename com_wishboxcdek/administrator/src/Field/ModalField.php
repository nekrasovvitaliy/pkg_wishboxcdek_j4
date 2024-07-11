<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field;

use Exception;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Component\Wishboxcdek\Administrator\Table\OfficeTable;
use SimpleXMLElement;
use Wishbox\Field\ListField;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class ModalField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'Modal';

	/**
	 * City code.
	 *
	 * @var    integer
	 *
	 * @since  1.0.0
	 */
	protected int $cityCode;

	/**
	 * Shipping method id
	 *
	 * @var    integer
	 *
	 * @since  1.0.0
	 */
	protected int $shippingMethodId;

	/**
	 * Name of the layout being used to render the field
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $layout = 'components.wishboxcdek.field.modal';

	/**
	 * Method to attach a Form object to the field.
	 *
	 * @param   SimpleXMLElement   $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed              $value    The form field value to validate.
	 * @param   string             $group    The field name group control value. This acts as an array container for the field.
	 *                                       For example, if the field has name="foo" and the group value is set to "bar" then the
	 *                                       full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     FormField::setup()
	 *
	 * @var   SimpleXMLElement $element Element
	 *
	 * @since 1.0.0
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null): bool
	{
		$return = parent::setup($element, $value, $group);

		if ($return)
		{
			$this->shopName = (string) $this->element['shop_name'];
			$this->cityCode = (int) $this->element['cityCode'];
			$this->shippingMethodId = (int) $this->element['shippingMethodId'];
		}

		return $return;
	}

	/**
	 * Method to get the list of options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 */
	protected function getOptions(): array
	{
		$app = Factory::getApplication();
		$options = [];

		if ($this->cityCode)
		{
			/** @var OfficeTable $officeTable */
			$officeTable = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createTable('Office', 'Administrator');

			$offices = $officeTable->getItems($this->cityCode);

			if (count($offices))
			{
				foreach ($offices as $office)
				{
					$options[] = HTMLHelper::_(
						'select.option',
						$office->code,
						$office->name
					);
				}
			}
		}

		if (!count($options) && $this->value && $this->value !== '-1')
		{
			/** @var OfficeTable $officeTable */
			$officeTable = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createTable('Office', 'Administrator');

			if (!$officeTable->load(['code' => $this->value]))
			{
				$app->enqueueMessage(
					'Cdek office with code ' . $this->value . 'is not exists',
					CMSApplicationInterface::MSG_CRITICAL
				);
			}

			$options[] = HTMLHelper::_(
				'select.option',
				$officeTable->code,
				$officeTable->name
			);
		}

		// Merge any additional options in the XML definition.
		return array_merge(parent::getOptions(), $options);
	}

	/**
	 * Method to get the data to be passed to the layout for rendering.
	 *
	 * @return  array
	 *
	 * @since 1.0.0
	 */
	protected function getLayoutData()
	{
		$layoutData = parent::getLayoutData();

		$layoutData['shopName'] = $this->shopName;
		$layoutData['cityCode'] = $this->cityCode;
		$layoutData['shippingMethodId'] = $this->shippingMethodId;

		return $layoutData;
	}
}
