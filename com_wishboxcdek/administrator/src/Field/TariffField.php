<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field;

use Exception;
use Joomla\Component\Wishboxcdek\Administrator\Helper\WishboxcdekHelper;
use Joomla\Utilities\ArrayHelper;
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
class TariffField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'Tariff';

	/**
	 * @var integer|null $filterCode Filter code
	 *
	 * @since  1.0.0
	 */
	private ?int $filterCode;

	/**
	 * @var integer[]|null $allowedCodes Allowed codes
	 *
	 * @since  1.0.0
	 */
	private ?array $allowedCodes = null;

	/**
	 * @var float[]|null $pricesByCodes Prices by codes
	 *
	 * @since  1.0.0
	 */
	private ?array $pricesByCodes = null;

	/**
	 * @var string[]|null $periodsByCodes Periods codes
	 *
	 * @since  1.0.0
	 */
	private ?array $periodsByCodes = null;

	/**
	 * @var boolean|null $addPrices Add prices
	 *
	 * @since  1.0.0
	 */
	private ?bool $addPrices = null;

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
			$this->filterCode = (int) $this->element['filterCode'];

			$allowedCodes = (string) $this->element['available_codes'];

			if (!empty($allowedCodes))
			{
				$allowedCodes = explode(',', $allowedCodes);
				$allowedCodes = ArrayHelper::toInteger($allowedCodes);

				$this->allowedCodes = $allowedCodes;
			}

			$pricesByCodes = $this->element['prices_by_codes'];

			if ($pricesByCodes !== null)
			{
				$pricesByCodes = (string) $pricesByCodes;

				$pricesByCodes = json_decode($pricesByCodes, true);

				if (!is_array($pricesByCodes))
				{
					$pricesByCodes = [];
				}

				$this->pricesByCodes = $pricesByCodes;
			}

			$periodsByCodes = $this->element['periods_by_codes'];

			if ($periodsByCodes !== null)
			{
				$periodsByCodes = (string) $periodsByCodes;

				$periodsByCodes = json_decode($periodsByCodes, true);

				if (!is_array($periodsByCodes))
				{
					$periodsByCodes = [];
				}

				$this->periodsByCodes = $periodsByCodes;
			}

			$addPrices = $this->element['add_prices'];

			if ($addPrices !== null)
			{
				$addPrices = (string) $addPrices;

				$addPrices = (bool) $addPrices;

				$this->addPrices = $addPrices;
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
		$options = parent::getOptions();

		$tariffOptions = WishboxcdekHelper::getTariffOptions($this->filterCode);

		if ($this->allowedCodes)
		{
			foreach ($tariffOptions as $k => $tariffOption)
			{
				if (!in_array((int) $tariffOption->value, $this->allowedCodes))
				{
					unset($tariffOptions[$k]);
				}
			}
		}

		if (is_array($this->pricesByCodes))
		{
			foreach ($tariffOptions as $k => $tariffOption)
			{
				if (isset($this->pricesByCodes[$tariffOption->value]))
				{
					if ($this->addPrices)
					{
						$tariffOptions[$k]->text .= ' (' . $this->pricesByCodes[$tariffOption->value] . ' руб.)';
					}
				}
				else
				{
					unset($tariffOptions[$k]);
				}
			}
		}

		if (is_array($this->periodsByCodes))
		{
			foreach ($tariffOptions as $k => $tariffOption)
			{
				if (isset($this->periodsByCodes[$tariffOption->value]))
				{
					$tariffOptions[$k]->text .= ' (' . $this->periodsByCodes[$tariffOption->value] . ')';
				}
				else
				{
					unset($tariffOptions[$k]);
				}
			}
		}

		return array_merge($options, $tariffOptions);
	}
}
