<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Field;

use Exception;
use Joomla\Component\Wishboxcdek\Administrator\Helper\WishboxcdekHelper;
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
class WishboxCdekStatusField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  1.0.0
	 */
	protected $type = 'wishboxcdekstatus';

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

		$statusOptions = WishboxcdekHelper::getStatusOptions();

		return array_merge($options, $statusOptions);
	}
}
