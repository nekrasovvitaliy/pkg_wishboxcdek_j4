<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\Component\Wishboxcdek\Administrator\Table\CityTable;
use Joomla\Component\Wishboxcdek\Administrator\Table\OfficeTable;
use SimpleXMLElement;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class OfficeGoogleMapField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'OfficeGoogleMap';

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
	 * @var array|null
	 *
	 * @since 1.0.0
	 */
	protected ?array $packages = null;

	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected $layout = 'components.wishboxcdek.field.officegooglemap';

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

			$packages = (string) $this->element['packages'];
			$packages = json_decode($packages);

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
	protected function getMarkers(): array
	{
		$app = Factory::getApplication();
		$markers = [];

		if ($this->cityCode)
		{
			/** @var OfficeTable $officeTable */
			$officeTable = $app->bootComponent('com_wishboxcdek')
				->getMVCFactory()
				->createTable('Office', 'Administrator');

			$offices = $officeTable->getItems($this->cityCode, $this->allowedCod, $this->packages);

			if (count($offices))
			{
				foreach ($offices as $office)
				{
					$markers[] = [
						'lat' => $office->location_latitude,
						'lng' => $office->location_longitude,
						'name' => $office->name,
						'code' => $office->code
					];
				}
			}

			if (!count($markers) && $this->value && $this->value !== '-1')
			{
				/** @var OfficeTable $officeTable */
				$officeTable = $app->bootComponent('com_wishboxcdek')
					->getMVCFactory()
					->createTable('Office', 'Administrator');

				if ($officeTable->load(['city_code' => $this->cityCode, 'code' => $this->value]))
				{
					$markers[] = [
						'lat' => $officeTable->location_latitude,
						'lng' => $officeTable->location_longitude
					];
				}
			}
		}

		return $markers;
	}

	/**
	 * @return array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function getLayoutData(): array
	{
		$layoutData = parent::getLayoutData();

		$app = Factory::getApplication();

		/** @var CityTable $cityTable */
		$cityTable = $app->bootComponent('com_wishboxcdek')
			->getMVCFactory()
			->createTable('City', 'Administrator');
		$cityTable->load(['code' => $this->cityCode]);
		$layoutData['center'] = [
			'lat' => $cityTable->latitude,
			'lng' => $cityTable->longitude
		];
		$layoutData['markers'] = $this->getMarkers();

		return $layoutData;
	}
}
