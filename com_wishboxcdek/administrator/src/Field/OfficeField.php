<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Component\Wishboxcdek\Administrator\Table\OfficeTable;
use Joomla\Component\Wishboxcdek\Site\Model\OfficesModel;
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
class OfficeField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'Office';

	/**
	 * City code.
	 *
	 * @var    integer
	 *
	 * @since  1.0.0
	 */
	protected int $cityCode;

	/**
	 * Разрешен наложенный платеж, может принимать значения:
	 *
	 * «1», «true» - да;
	 * «0», «false» - нет.
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected ?bool $allowedCod = null;

	/**
	 * Тип офиса. Принимает значения: "POSTAMAT", "PVZ", "ALL".
	 *
	 * При отсутствии параметра принимается значение по умолчанию «ALL».
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $deliveryPointType = 'ALL';

	/**
	 * @var array|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $packages = null;

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
			$this->cityCode = (int) $this->element['cityCode'];

			$allowedCod = (string) $this->element['allowed_cod'];

			if ($allowedCod)
			{
				$this->allowedCod = (bool) $allowedCod;
			}

			$deliveryPointType = (string) $this->element['deliverypoint_type'];

			if ($deliveryPointType)
			{
				$this->deliveryPointType = $deliveryPointType;
			}

			$packagesData = (string) $this->element['packages'];
			$packages = json_decode($packagesData);

			if (is_array($packages))
			{
				$this->packages = $packages;
			}
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

		if ($this->cityCode > 0)
		{
			/** @var OfficesModel $officesModel */
			$officesModel = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createModel(
					'offices',
					'Site',
					['ignore_request' => true]
				);

			$officesModel->setState('filter.city_code', $this->cityCode);
			$officesModel->setState('filter.allowed_cod', $this->allowedCod);
			$officesModel->setState('filter.type', $this->deliveryPointType);
			$packagesData = json_encode($this->packages);
			$officesModel->setState('filter.packages_data', $packagesData);
			$offices = $officesModel->getItems();

			if (count($offices))
			{
				foreach ($offices as $office)
				{
					$options[] = HTMLHelper::_(
						'select.option',
						$office->code,
						$office->name . ' (' . $office->type . ' )'
					);
				}
			}

			if (!count($options) && $this->value && $this->value !== '-1')
			{
				/** @var OfficeTable $officeTable */
				$officeTable = $app->bootComponent('com_wishboxcdek')
					->getMVCFactory()
					->createTable('Office', 'Administrator', ['ignore_request' => true]);

				if ($officeTable->load(['city_code' => $this->cityCode, 'code' => $this->value]))
				{
					$options[] = HTMLHelper::_(
						'select.option',
						$officeTable->code,
						$officeTable->address
					);
				}
			}
		}

		// Merge any additional options in the XML definition.
		return array_merge(parent::getOptions(), $options);
	}
}
