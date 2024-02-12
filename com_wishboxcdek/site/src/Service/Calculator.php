<?php
/**
 * @copyright 2023 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

require_once JPATH_SITE . '/vendor/autoload.php';

use AntistressStore\CdekSDK2\Entity\Requests\Package;
use AntistressStore\CdekSDK2\Entity\Requests\Tariff;
use AntistressStore\CdekSDK2\Entity\Responses\TariffListResponse;
use Exception;
use InvalidArgumentException;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use UnexpectedValueException;
use Wishbox\ShippingService\Cdek\Interface\CalculatorDelegateInterface;
use Wishbox\ShippingService\ShippingTariff;
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
	 * @return TariffListResponse
	 *
	 * @since 1.0.0
	 */
	private function getMinTariff(array $tariffs): TariffListResponse
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
		$weight = $this->delegate->getTotalWeight();

		if ($weight <= 0)
		{
			throw new UnexpectedValueException('$weight must be greater than zero');
		}

		$tariff = new Tariff;

		$receiverCityCode = $this->delegate->getReceiverCityCode();

		if (!$receiverCityCode)
		{
			return [];
		}

		$tariff->setCityCodes($this->delegate->getSenderCityCode(), $receiverCityCode);
		$tariff->setPackageWeight($weight);
		$packages = $this->getPackages();

		foreach ($packages as $package)
		{
			$tariff->setPackages($package);
		}

		$apiClient = $this->getApiClient();

		$tariffs = $apiClient->calculateTariffList($tariff);

		$tariffCodes = $this->delegate->getTariffCodes();

		if (count($tariffCodes))
		{
			foreach ($tariffs as $k => $tariff)
			{
				if (!in_array($tariff->getTariffCode(), $tariffCodes))
				{
					unset($tariffs[$k]);
				}
			}
		}

		return array_values($tariffs);
	}

	/**
	 * Metod returns array of packages
	 *
	 * @return   array
	 *
	 * @since 1.0.0
	 */
	private function getPackages(): array
	{
		$packages = [];

		if ($this->delegate->getCalculationMethod() == 'without_parcels')
		{
			$package = (new Package)
				->setNumber('1')
				->setWeight($this->delegate->getTotalWeight())
				->setWidth($this->delegate->getPackageWidth())
				->setHeight($this->delegate->getPackageHeight())
				->setLength($this->delegate->getPackageLength());
			$packages[] = $package;
		}
		elseif ($this->delegate->getCalculationMethod() == 'with_parcels')
		{
			$products = $this->delegate->getProducts();

			foreach ($products as $prod)
			{
				for ($k = 0; $k < $prod['quantity']; $k++)
				{
					$package = new Package;
					$package->setNumber(count($packages) + 1);
					$package->setWeight(floatval($prod['weight']) * 1000);

					if ($this->delegate->useDimencions())
					{
						$package->setWidth($prod['dimensions']['width'])
							->setHeight(['dimensions']['height'])
							->setLength(['dimensions']['length']);
					}

					$packages[] = $package;
				}
			}
		}

		return $packages;
	}
}
