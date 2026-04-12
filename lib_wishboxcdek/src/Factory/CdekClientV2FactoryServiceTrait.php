<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use UnexpectedValueException;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for the CdekClientV2Factory service class.
 *
 * @since  1.0.0
 */
trait CdekClientV2FactoryServiceTrait
{
	/**
	 * The API client.
	 *
	 * @var CdekClientV2FactoryInterface|null
	 *
	 * @since 1.0.0
	 */
	private ?CdekClientV2FactoryInterface $cdekClientV2Factory = null;

	/**
	 * Get the API client.
	 *
	 * @return  CdekClientV2FactoryInterface
	 *
	 * @throws  UnexpectedValueException May be thrown if the factory has not been set.
	 *
	 * @since   1.0.0
	 */
	public function getCdekClientV2Factory(): CdekClientV2FactoryInterface
	{
		if (!$this->cdekClientV2Factory)
		{
			throw new UnexpectedValueException('CdekClientV2FactoryInterface not set in ' . __CLASS__);
		}

		return $this->cdekClientV2Factory;
	}

	/**
	 * The API client.
	 *
	 * @param   CdekClientV2FactoryInterface  $cdekClientV2Factory  CdekClientV2Factory
	 *
	 * @return  void
	 *
	 * @since  1.0.0
	 */
	public function setCdekClientV2Factory(CdekClientV2FactoryInterface $cdekClientV2Factory): void
	{
		$this->cdekClientV2Factory = $cdekClientV2Factory;
	}
}
