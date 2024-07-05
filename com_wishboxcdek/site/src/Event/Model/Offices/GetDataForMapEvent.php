<?php
/**
 * @copyright  2013-2024 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Event\Model\Offices;

use BadMethodCallException;
use Joomla\CMS\Event\AbstractImmutableEvent;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('JPATH_PLATFORM') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since  1.0.0
 */
class GetDataForMapEvent extends AbstractImmutableEvent
{
	/**
	 * Constructor.
	 *
	 * @param   string  $name       The event name.
	 * @param   array   $arguments  The event arguments.
	 *
	 * @throws  BadMethodCallException
	 *
	 * @since   1.0.0
	 */
	public function __construct($name, array $arguments = [])
	{
		if (!isset($arguments['context']))
		{
			throw new BadMethodCallException(
				"Argument 'context' of event $this->name is required but has not been provided"
			);
		}

		if (isset($arguments['shippingMethodId']))
		{
			throw new BadMethodCallException(
				"Argument 'shippintMethodId' of event $this->name is required but has not been provided"
			);
		}

		parent::__construct($name, $arguments);
	}
}
