<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace WishboxCdekLibrary\MVC\Factory;

use Exception;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Cache\CacheControllerFactoryAwareInterface;
use Joomla\CMS\Cache\CacheControllerFactoryAwareTrait;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryAwareInterface;
use Joomla\CMS\Form\FormFactoryAwareTrait;
use Joomla\CMS\Mail\MailerFactoryAwareInterface;
use Joomla\CMS\Mail\MailerFactoryAwareTrait;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ModelInterface;
use Joomla\CMS\Router\SiteRouterAwareInterface;
use Joomla\CMS\Router\SiteRouterAwareTrait;
use Joomla\CMS\User\UserFactoryAwareInterface;
use Joomla\CMS\User\UserFactoryAwareTrait;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Database\DatabaseInterface;
use Joomla\Database\Exception\DatabaseNotFoundException;
use Joomla\Event\DispatcherAwareInterface;
use Joomla\Event\DispatcherAwareTrait;
use Joomla\Input\Input;
use UnexpectedValueException;
use WishboxCdekLibrary\Factory\RequestFactoryAwareInterface;
use WishboxCdekLibrary\Factory\RequestFactoryAwareTrait;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use function defined;
use function sprintf;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Factory to create MVC objects based on a namespace.
 *
 * @since  1.0.0
 */
class MVCFactory extends \Joomla\CMS\MVC\Factory\MVCFactory implements MVCFactoryInterface,
	FormFactoryAwareInterface,
	SiteRouterAwareInterface,
	UserFactoryAwareInterface,
	MailerFactoryAwareInterface
{
	use FormFactoryAwareTrait;
	use DispatcherAwareTrait;
	use DatabaseAwareTrait;
	use SiteRouterAwareTrait;
	use CacheControllerFactoryAwareTrait;
	use UserFactoryAwareTrait;
	use MailerFactoryAwareTrait;
	use RequestFactoryAwareTrait;
	use CdekClientAwareTrait;
	use ControllerServiceAwareFactoryTrait;

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
	 * @throws  Exception
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function createController($name, $prefix, array $config, CMSApplicationInterface $app, Input $input)
	{
		return $this->setControllerServices(
			parent::createController($name, $prefix, $config, $app, $input)
		);
	}

	/**
	 * Method to load and return a model object.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  Optional model prefix.
	 * @param   array   $config  Optional configuration array for the model.
	 *
	 * @return  ModelInterface  The model object
	 *
	 * @throws  Exception
	 *
	 * @since        1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 * @noinspection PhpUnusedLocalVariableInspection
	 */
	public function createModel($name, $prefix = '', array $config = [])
	{
		// Clean the parameters
		$name   = preg_replace('/[^A-Z0-9_]/i', '', $name);
		$prefix = preg_replace('/[^A-Z0-9_\\\\]/i', '', $prefix);

		if (!$prefix)
		{
			@trigger_error(
				sprintf(
					'Calling %s() without a prefix is deprecated.',
					__METHOD__
				),
				E_USER_DEPRECATED
			);

			$prefix = Factory::getApplication()->getName();
		}

		if (!mb_strpos($prefix, "\\"))
		{
			$className = $this->getClassName('Model\\' . ucfirst($name) . 'Model', $prefix);
		}
		else
		{
			$className = $this->getClassName(ucfirst($name) . 'Model', $prefix);
		}

		if (!$className)
		{
			return null;
		}

		$model = new $className($config, $this);

		if ($model instanceof FormFactoryAwareInterface)
		{
			try
			{
				$model->setFormFactory($this->getFormFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof DispatcherAwareInterface)
		{
			try
			{
				$model->setDispatcher($this->getDispatcher());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof DispatcherAwareInterface)
		{
			try
			{
				$model->setDispatcher($this->getDispatcher());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof SiteRouterAwareInterface)
		{
			try
			{
				$model->setSiteRouter($this->getSiteRouter());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof CacheControllerFactoryAwareInterface)
		{
			try
			{
				$model->setCacheControllerFactory($this->getCacheControllerFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof CacheControllerFactoryAwareInterface)
		{
			try
			{
				$model->setCacheControllerFactory($this->getCacheControllerFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof UserFactoryAwareInterface)
		{
			try
			{
				$model->setUserFactory($this->getUserFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof MailerFactoryAwareInterface)
		{
			try
			{
				$model->setMailerFactory($this->getMailerFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof DatabaseAwareInterface)
		{
			try
			{
				$model->setDatabase($this->getDatabase());
			}
			catch (DatabaseNotFoundException $e)
			{
				@trigger_error('Database must be set, this will not be caught anymore in 5.0.', E_USER_DEPRECATED);
				$model->setDatabase(Factory::getContainer()->get(DatabaseInterface::class));
			}
		}

		if ($model instanceof RequestFactoryAwareInterface)
		{
			try
			{
				$model->setRequestFactory($this->getRequestFactory());
			}
			catch (UnexpectedValueException $e)
			{
				// Ignore it
			}
		}

		if ($model instanceof CdekClientAwareInterface)
		{
			$model->setCdekClient($this->getCdekClient());
		}

		return $model;
	}
}
