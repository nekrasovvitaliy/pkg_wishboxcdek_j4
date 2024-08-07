<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use Exception;
use InvalidArgumentException;
use Joomla\Component\Wishboxcdek\Site\Interface\CalculatorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Service\RequestCreator\TariffListPostRequestCreator;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use Wishbox\ShippingService\ShippingTariff;
use WishboxCdekSDK2\Model\Response\Calculator\TariffListPost\TariffCodeResponse;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class Calculator
{
	use ApiClientTrait;

	/**
	 * @var CalculatorDelegateInterface $delegate
	 *
	 * @since 1.0.0
	 */
	protected CalculatorDelegateInterface $delegate;

	/**
	 * @var array $tariffs
	 *
	 * @since 1.0.0
	 */
	protected static array $tariffs;

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
	 * Returns shipping price
	 *
	 * @return ShippingTariff|null
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getTariff(): ?ShippingTariff
	{
		$shippingTariff = $this->getShippingTariff();

		self::$tariffs[$this->delegate->getShippingMethodId()] = $shippingTariff;

		return $shippingTariff;
	}

	/**
	 * Returns tariff
	 *
	 * @return ShippingTariff
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getShippingTariff(): ShippingTariff
	{
		$shippingTariff = new ShippingTariff(0, 0);

		$tariffs = $this->getTariffs();

		if (count($tariffs))
		{
			$minTariff = $this->getMinTariff($tariffs);
			$periodMin = $minTariff->getPeriodMin();
			$periodMax = $minTariff->getPeriodMax();
			$shipping = $minTariff->getDeliverySum();
			$code = $minTariff->getTariffCode();
			$name = $minTariff->getTariffName();
			$shippingTariff->setPeriodMin($periodMin)
				->setPeriodMax($periodMax)
				->setShipping($shipping)
				->setCode($code)
				->setName($name);
		}

		return $shippingTariff;
	}

	/**
	 * Метод возвращает самый дешевый тариф из массива
	 *
	 * @param   array $tariffs  Tariffs
	 *
	 * @return TariffCodeResponse
	 *
	 * @since 1.0.0
	 */
	private function getMinTariff(array $tariffs): TariffCodeResponse
	{
		if (!count($tariffs))
		{
			throw new InvalidArgumentException('Array of tariffs must not be empty', 500);
		}

		$minTariff = $tariffs[0];

		foreach ($tariffs as $tariff)
		{
			if ($tariff->getDeliverySum() < $minTariff->getDeliverySum())
			{
				$minTariff = $tariff;
			}
		}

		return $minTariff;
	}

	/**
	 * Method
	 *
	 * @return array
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getTariffs(): array
	{
		$tariffListPostRequestCreator = new TariffListPostRequestCreator($this->delegate);
		$tariffListPostRequest = $tariffListPostRequestCreator->getRequest();

		$receiverCityCode = $this->delegate->getReceiverCityCode();

		if (!$receiverCityCode)
		{
			return [];
		}

		$apiClient = $this->getApiClient();

		$tariffListPostResponse = $apiClient->calculateTariffList($tariffListPostRequest);
		$tariffCodes = $tariffListPostResponse->getTariffCodes();

		$requiredTariffCodes = $this->delegate->getTariffCodes();

		if (count($tariffCodes))
		{
			foreach ($tariffCodes as $k => $tariff)
			{
				if (!in_array($tariff->getTariffCode(), $requiredTariffCodes))
				{
					unset($tariffCodes[$k]);
				}
			}
		}

		return array_values($tariffCodes);
	}
}
