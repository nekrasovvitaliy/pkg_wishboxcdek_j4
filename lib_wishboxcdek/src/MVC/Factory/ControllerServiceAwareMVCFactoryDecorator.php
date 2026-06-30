<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\MVC\Factory;

use Exception;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Decorates MVC factory with library service injection support for controllers.
 *
 * @since  1.0.0
 */
class ControllerServiceAwareMVCFactoryDecorator implements MVCFactoryInterface
{
	use ControllerServiceAwareFactoryTrait;

	/**
	 * @var MVCFactoryInterface
	 *
	 * @since 1.0.0
	 */
	private MVCFactoryInterface $mvcFactory;

	/**
	 * Constructor.
	 *
	 * @param   MVCFactoryInterface  $mvcFactory  Decorated MVC factory
	 *
	 * @since  1.0.0
	 */
	public function __construct(MVCFactoryInterface $mvcFactory)
	{
		$this->mvcFactory = $mvcFactory;
	}

	/**
	 * Method to load and return a controller object.
	 *
	 * @param   string                   $name    The controller name.
	 * @param   string                   $prefix  Optional controller prefix.
	 * @param   array                    $config  Optional configuration array.
	 * @param   CMSApplicationInterface  $app     The application object.
	 * @param   Input                    $input   The input object.
	 *
	 * @return  object|null
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function createController($name, $prefix, array $config, CMSApplicationInterface $app, Input $input)
	{
		return $this->setControllerServices(
			$this->mvcFactory->createController($name, $prefix, $config, $app, $input)
		);
	}

	/**
	 * Method to load and return a model object.
	 *
	 * @param   string  $name    The model name.
	 * @param   string  $prefix  Optional model prefix.
	 * @param   array   $config  Optional configuration array.
	 *
	 * @return  object|null
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function createModel($name, $prefix = '', array $config = [])
	{
		return $this->mvcFactory->createModel($name, $prefix, $config);
	}

	/**
	 * Method to load and return a view object.
	 *
	 * @param   string  $name    The view name.
	 * @param   string  $prefix  Optional view prefix.
	 * @param   string  $type    Optional view type.
	 * @param   array   $config  Optional configuration array.
	 *
	 * @return  object|null
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function createView($name, $prefix = '', $type = '', array $config = [])
	{
		return $this->mvcFactory->createView($name, $prefix, $type, $config);
	}

	/**
	 * Method to load and return a table object.
	 *
	 * @param   string  $name    The table name.
	 * @param   string  $prefix  Optional table prefix.
	 * @param   array   $config  Optional configuration array.
	 *
	 * @return  object|null
	 *
	 * @throws Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function createTable($name, $prefix = '', array $config = [])
	{
		return $this->mvcFactory->createTable($name, $prefix, $config);
	}
}
