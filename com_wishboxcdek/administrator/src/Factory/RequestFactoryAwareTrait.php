<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\WishboxCdek\Administrator\Factory;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a RequestFactoryInterface Aware Class.
 *
 * @since  1.0.0
 */
trait RequestFactoryAwareTrait
{
	/**
	 * RequestFactoryInterface
	 *
	 * @var    RequestFactoryInterface|null
	 *
	 * @since  1.0.0
	 */
	private ?RequestFactoryInterface $requestFactory = null;

	/**
	 * Get the RequestFactoryInterface.
	 *
	 * @return  RequestFactoryInterface
	 *
	 * @throws  UnexpectedValueException May be thrown if the RequestFactory has not been set.
	 *
	 * @since   1.0.0
	 */
	protected function getRequestFactory(): RequestFactoryInterface
	{
		if ($this->requestFactory)
		{
			return $this->requestFactory;
		}

		throw new UnexpectedValueException('RequestFactory not set in ' . __CLASS__);
	}

	/**
	 * Set the user factory to use.
	 *
	 * @param   RequestFactoryInterface  $requestFactory  The request factory to use.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function setRequestFactory(RequestFactoryInterface $requestFactory): void
	{
		$this->requestFactory = $requestFactory;
	}
}
