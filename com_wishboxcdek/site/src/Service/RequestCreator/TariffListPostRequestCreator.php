<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrsov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service\RequestCreator;

use Exception;
use Joomla\Component\Wishboxcdek\Site\Interface\CalculatorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPostRequest;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class TariffListPostRequestCreator
{
	use ApiClientTrait;

	/**
	 * @var CalculatorDelegateInterface $delegate
	 *
	 * @since 1.0.0
	 */
	protected CalculatorDelegateInterface $delegate;

	/**
	 * @param   CalculatorDelegateInterface  $delegate Delegate
	 *
	 * @since 1.0.0
	 */
	public function __construct(CalculatorDelegateInterface $delegate)
	{
		$this->delegate = $delegate;
	}

	/**
	 * @return TariffListPostRequest
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getRequest(): TariffListPostRequest
	{
		$tariffListPostRequest = new TariffListPostRequest;
		$this->setOrderData($tariffListPostRequest);

		return $tariffListPostRequest;
	}

	/**
	 * @param   TariffListPostRequest $tariffListPostRequest  TariffListPostRequest
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	protected function setOrderData(TariffListPostRequest $tariffListPostRequest): void
	{
		$weight = $this->delegate->getTotalWeight();
		$senderCityCode = $this->delegate->getSenderCityCode();
		$receiverCityCode = $this->delegate->getReceiverCityCode();
		$tariffListPostRequest->setCityCodes($senderCityCode, $receiverCityCode);
		$tariffListPostRequest->setPackageWeight($weight);

		$packages = $this->delegate->getPackages();
		$tariffListPostRequest->setPackages($packages);
	}
}
