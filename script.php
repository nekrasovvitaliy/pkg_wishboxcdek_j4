<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Version;
use Joomla\Database\DatabaseDriver;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

defined('_JEXEC') or die;

return new class implements ServiceProviderInterface
{
	/**
	 * @param   Container  $container Container
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function register(Container $container): void
	{
		$container->set(
			InstallerScriptInterface::class,
			new class ($container->get(AdministratorApplication::class)) implements InstallerScriptInterface
			{
				/**
				 * The application object
				 *
				 * @var  AdministratorApplication
				 *
				 * @since  1.0.0
				 */
				protected AdministratorApplication $app;

				/**
				 * The Database object.
				 *
				 * @var   DatabaseDriver
				 *
				 * @since  1.0.0
				 */
				protected DatabaseDriver $db;

				/**
				 * Minimum Joomla version required to install the extension.
				 *
				 * @var  string
				 *
				 * @since  1.0.0
				 */
				protected string $minimumJoomla = '4.4.3';

				/**
				 * Minimum PHP version required to install the extension.
				 *
				 * @var  string
				 *
				 * @since 1.0.0
				 */
				protected string $minimumPhp = '8.1';

				/**
				 * Constructor.
				 *
				 * @param   AdministratorApplication  $app  The application object.
				 *
				 * @since 1.0.0
				 */
				public function __construct(AdministratorApplication $app)
				{
					$this->app = $app;
					$this->db  = Factory::getContainer()->get('DatabaseDriver');
				}

				/**
				 * Function called after the extension is installed.
				 *
				 * @param   InstallerAdapter  $adapter  The adapter calling this method
				 *
				 * @return  boolean  True on success
				 *
				 * @since   1.0.0
				 */
				public function install(InstallerAdapter $adapter): bool
				{
					return true;
				}

				/**
				 * Function called after the extension is updated.
				 *
				 * @param   InstallerAdapter  $adapter  The adapter calling this method
				 *
				 * @return  boolean  True on success
				 *
				 * @since   1.0.0
				 */
				public function update(InstallerAdapter $adapter): bool
				{
					return true;
				}

				/**
				 * Function called after the extension is uninstalled.
				 *
				 * @param   InstallerAdapter  $adapter  The adapter calling this method
				 *
				 * @return  boolean  True on success
				 *
				 * @since   1.0.0
				 */
				public function uninstall(InstallerAdapter $adapter): bool
				{
					return true;
				}

				/**
				 * Function called before extension installation/update/removal procedure commences.
				 *
				 * @param   string            $type     The type of change (install or discover_install, update, uninstall)
				 * @param   InstallerAdapter  $adapter  The adapter calling this method
				 *
				 * @return  boolean  True on success
				 *
				 * @since   1.0.0
				 */
				public function preflight(string $type, InstallerAdapter $adapter): bool
				{
					// Check compatible
					if (!$this->checkCompatible())
					{
						return false;
					}

					return true;
				}

				/**
				 * Function called after extension installation/update/removal procedure commences.
				 *
				 * @param   string            $type     The type of change (install or discover_install, update, uninstall)
				 * @param   InstallerAdapter  $adapter  The adapter calling this method
				 *
				 * @return  boolean  True on success
				 *
				 * @since   1.0.0
				 */
				public function postflight(string $type, InstallerAdapter $adapter): bool
				{
					return true;
				}

				/**
				 * Method to check compatible.
				 *
				 * @throws  Exception
				 *
				 * @return  boolean True on success, False on failure.
				 *
				 * @since  1.0.0
				 */
				protected function checkCompatible(): bool
				{
					$app = Factory::getApplication();

					// Check joomla version
					if (!(new Version)->isCompatible($this->minimumJoomla))
					{
						$app->enqueueMessage(
							Text::sprintf('PLG_WISHBOXCDEK_ERROR_COMPATIBLE_JOOMLA', $this->minimumJoomla),
							'error'
						);

						return false;
					}

					// Check PHP
					if (!(version_compare(PHP_VERSION, $this->minimumPhp) >= 0))
					{
						$app->enqueueMessage(
							Text::sprintf('PKG_WISHBOXCDEK_ERROR_COMPATIBLE_PHP', $this->minimumPhp),
							'error'
						);

						return false;
					}

					return true;
				}
			}
		);
	}
};
