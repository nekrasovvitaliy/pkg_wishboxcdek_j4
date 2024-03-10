<?php
/**
 * @copyright (c) 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Administrator\Table;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Access\Access;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table as Table;
use Joomla\Registry\Registry;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Class Base
 *
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class BaseTable extends Table
{
	/**
	 * @var integer $id Id
	 *
	 * @since 1.0.0
	 */
	public int $id = 0;

	/**
	 * @var integer $ordering Ordering
	 *
	 * @since 1.0.0
	 */
	public int $ordering = 0;

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array|object  $src     An associative array or object to bind to the Table instance.
	 * @param   array|string  $ignore  An optional array or space separated list of properties to ignore while binding.
	 *
	 * @return  boolean  True on success.
	 *
	 * @throws  InvalidArgumentException|Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function bind($src, $ignore = '')
	{
		$app = Factory::getApplication();
		$user = $app->getIdentity();

		$input = Factory::getApplication()->input;
		$task = $input->getString('task', '');

		if ($src['id'] == 0 && empty($array['created_by']))
		{
			$src['created_by'] = $user->id;
		}

		if ($src['id'] == 0 && empty($src['modified_by']))
		{
			$src['modified_by'] = $user->id;
		}

		if ($task == 'apply' || $task == 'save')
		{
			$src['modified_by'] = $user->id;
		}

		if (isset($src['params']) && is_array($src['params']))
		{
			$registry = new Registry;
			$registry->loadArray($src['params']);
			$src['params'] = (string) $registry;
		}

		if ($app->isClient('administrator'))
		{
			if (!$user->authorise('core.admin', 'com_wishboxcdek'))
			{
				$actions        = Access::getActionsFromFile(
					JPATH_ADMINISTRATOR . '/components/com_wishboxcdek/access.xml',
					"/access/section[@name='classtype']/"
				);
				$defaultActions = Access::getAssetRules('com_wishboxcdek')->getData();
				$arrayJaccess   = [];

				foreach ($actions as $action)
				{
					if (key_exists($action->name, $defaultActions))
					{
						$arrayJaccess[$action->name] = $defaultActions[$action->name];
					}
				}

				$src['rules'] = $this->JAccessRulestoArray($arrayJaccess);
			}
		}

		// Bind the rules for ACL where supported.
		if (isset($src['rules']) && is_array($src['rules']))
		{
			$this->setRules($src['rules']);
		}

		return parent::bind($src, $ignore);
	}

	/**
	 * Method to store a row in the database from the Table instance properties.
	 *
	 * If a primary key value is set, the row with that primary key value will be updated with the instance property values.
	 * If no primary key value is set, a new row will be inserted into the database with the properties from the Table instance.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function store($updateNulls = true)
	{
		$app = Factory::getApplication();
		$date = Factory::getDate()->toSql();
		$user = $app->getIdentity();

		// Set created date if not set.
		if (!(int) $this->created)
		{
			$this->created = $date;
		}

		if ($this->id)
		{
			// Existing item
			$this->modified_by = $user->get('id'); // phpcs:ignore
			$this->modified    = $date;
		}
		else
		{
			// The user can set Field created_by, so we don't touch it if it's set.
			if (empty($this->created_by)) // phpcs:ignore
			{
				$this->created_by = $user->get('id'); // phpcs:ignore
			}

			// Set modified to created date if not set
			if (!(int) $this->modified)
			{
				$this->modified = $this->created;
			}

			// Set modified_by to created_by user if not set
			if (empty($this->modified_by)) // phpcs:ignore
			{
				$this->modified_by = $this->created_by; // phpcs:ignore
			}
		}

		return parent::store($updateNulls);
	}

	/**
	 * This function converts an array of Access objects into a rule array.
	 *
	 * @param   array  $jaccessrules  An array of Access objects.
	 *
	 * @return  array
	 *
	 * @since 1.0.0
	 */
	protected function JAccessRulestoArray(array $jaccessrules): array
	{
		$rules = [];

		foreach ($jaccessrules as $action => $jaccess)
		{
			$actions = [];

			if ($jaccess)
			{
				foreach ($jaccess->getData() as $group => $allow)
				{
					$actions[$group] = ((bool) $allow);
				}
			}

			$rules[$action] = $actions;
		}

		return $rules;
	}

	/**
	 * Returns the parent asset's id. If you have a tree structure, retrieve the parent's id using the external key field
	 *
	 * @param   Table    $table  Table name
	 * @param   integer  $id     Id
	 *
	 * @return mixed The id on success, false on failure.
	 *
	 * @see Table::_getAssetParentId
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 *
	 * @noinspection PhpMissingParamTypeInspection
	 */
	protected function _getAssetParentId($table = null, $id = null)  // phpcs:ignore
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = Table::getInstance('Asset');

		// Default: if no asset-parent can be found, we take the global asset
		$assetParentId = $assetParent->getRootId();

		// The item has the component as asset-parent
		$assetParent->loadByName('com_wishboxcdek');

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}

	/**
	 * Overloaded check function
	 *
	 * @return  boolean  True if the instance is correct and able to be stored in the database.
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function check()
	{
		// If there is an ordering column and this is a new row, then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}

		return parent::check();
	}

	/**
	 * Define a namespaced asset name for inclusion in the #__assets table
	 *
	 * @return string The asset name
	 *
	 * @see Table::_getAssetName
	 * @since 1.0.0
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	protected function _getAssetName() // phpcs:ignore
	{
		$k = $this->_tbl_key; // phpcs:ignore

		return $this->typeAlias . '.' . (int) $this->$k;
	}

	/**
	 * Delete a record by id
	 *
	 * @param   mixed  $pk  Primary key value to delete. Optional
	 *
	 * @return boolean
	 * @since 1.0.0
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function delete($pk = null)
	{
		$this->load($pk);

		return parent::delete($pk);
	}

	/**
	 * Get the type alias for the history table
	 *
	 * The type alias generally is the internal component name with the
	 * content type. Ex.: com_content.article
	 *
	 * @return  string  The alias as described above
	 *
	 * @since   1.0.0
	 */
	public function getTypeAlias(): string
	{
		return $this->typeAlias;
	}
}
