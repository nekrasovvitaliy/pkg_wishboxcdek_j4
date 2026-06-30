<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license         GNU General Public License version 2 or later
 */

namespace WishboxCdekLibrary\Service\Calculator;

use Exception;
use InvalidArgumentException;
use Joomla\Component\WishboxCdek\Site\Exception\NoAvailableTariffsException;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\DatabaseInterface;
use Wishbox\ShippingService\ShippingTariff;
use WishboxCdek\CdekClient;
use WishboxCdek\Response\Calculator\TariffCodeDto;
use WishboxCdekLibrary\Factory\RequestFactoryAwareInterface;
use WishboxCdekLibrary\Factory\RequestFactoryAwareTrait;
use WishboxCdekLibrary\Factory\RequestFactoryInterface;
use WishboxCdekLibrary\Interface\CalculatorAdapterInterface;
use WishboxCdekLibrary\Service\CdekClientAwareInterface;
use WishboxCdekLibrary\Service\CdekClientAwareTrait;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

// phpcs:disable PSR1.Files.SideEffects
require_once JPATH_SITE . '/vendor/autoload.php';
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property DatabaseDriver $db
 *
 * @since 1.0.0
 */
class CalculatorService implements CdekClientAwareInterface, DatabaseAwareInterface, RequestFactoryAwareInterface
{
	use CdekClientAwareTrait;
	use DatabaseAwareTrait;
	use RequestFactoryAwareTrait;

	/**
	 * @var array $tariffs
	 *
	 * @since 1.0.0
	 */
	protected static array $tariffs = [];

	/**
	 * Class constructor.
	 *
	 * @param   DatabaseInterface        $db              Database driver
	 * @param   CdekClient               $cdekClient      CDEK client
	 * @param   RequestFactoryInterface  $requestFactory  Request factory
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		DatabaseInterface $db,
		CdekClient $cdekClient,
		RequestFactoryInterface $requestFactory
	)
	{
		$this->setDatabase($db);
		$this->setCdekClient($cdekClient);
		$this->setRequestFactory($requestFactory);
	}

	/**
	 * Returns shipping price
	 *
	 * @param   CalculatorAdapterInterface  $adapter  Calculator adapter
	 *
	 * @return ShippingTariff|null
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getTariff(CalculatorAdapterInterface $adapter): ?ShippingTariff
	{
		$shippingTariff = $this->getShippingTariff($adapter);

		self::$tariffs[$adapter->getShippingMethodId()] = $shippingTariff;

		return $shippingTariff;
	}

	/**
	 * @param   CalculatorAdapterInterface  $adapter  Calculator adapter
	 *
	 * @return ShippingTariff[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getShippingTariffs(CalculatorAdapterInterface $adapter): array
	{
		$shippingTariffs = [];

		$tariffs = $this->getTariffs($adapter);

		if (count($tariffs))
		{
			foreach ($tariffs as $tariff)
			{
				$shippingTariff = new ShippingTariff(0, 0);

				$periodMin = $tariff->getPeriodMin();
				$periodMax = $tariff->getPeriodMax();
				$shipping  = $tariff->getDeliverySum();
				$code      = $tariff->getTariffCode();
				$name      = $tariff->getTariffName();
				$shippingTariff->setPeriodMin($periodMin)
					->setPeriodMax($periodMax)
					->setShipping($shipping)
					->setCode($code)
					->setName($name);
				$shippingTariffs[] = $shippingTariff;
			}
		}

		return $shippingTariffs;
	}

	/**
	 * @param   CalculatorAdapterInterface  $adapter  Calculator adapter
	 *
	 * @return ShippingTariff
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getShippingTariff(CalculatorAdapterInterface $adapter): ShippingTariff
	{
		$shippingTariff = new ShippingTariff(0, 0);
		$tariffs        = $this->getTariffs($adapter);

		if (count($tariffs))
		{
			$minTariff = $this->getMinTariff($tariffs);
			$periodMin = $minTariff->periodMin;
			$periodMax = $minTariff->periodMax;
			$shipping  = $minTariff->deliverySum;
			$code      = $minTariff->tariffCode;
			$name      = $minTariff->tariffName;
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
	 * @param   array  $tariffs  Tariffs
	 *
	 * @return TariffCodeDto
	 *
	 * @since 1.0.0
	 */
	private function getMinTariff(array $tariffs): TariffCodeDto
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
	 * @param   CalculatorAdapterInterface  $adapter  Calculator adapter
	 *
	 * @return array
	 *
	 * @throws NoAvailableTariffsException
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getTariffs(CalculatorAdapterInterface $adapter): array
	{
		$tariffListPostRequest = $this->getRequestFactory()->createCalculateTariffListRequest($adapter);

		$receiverCityCode = $adapter->getReceiverCityCode();

		if (!$receiverCityCode)
		{
			return [];
		}

		$calculateTariffListResponse = $this->getCdekClient()
			->calculator()
			->calculateTariffList(
				$tariffListPostRequest
			);
		$responseTariffCodes = $calculateTariffListResponse->tariffCodes;

		$requiredTariffCodes = $adapter->getTariffCodes();

		if (is_array($responseTariffCodes) && count($responseTariffCodes))
		{
			$db = $this->getDatabase();

			$query = $db->createQuery()
				->select($db->qn('code'))
				->from($db->qn('#__wishboxcdek_tariff_modes'));
			$db->setQuery($query);
			$tariffModes = $db->loadColumn();

			foreach ($responseTariffCodes as $tariffCodeDto)
			{
				if (!in_array($tariffCodeDto->deliveryMode, $tariffModes))
				{
					throw new Exception('Delivery mode not found', 500);
				}
			}
		}

		if (is_array($responseTariffCodes) && count($responseTariffCodes))
		{
			foreach ($responseTariffCodes as $k => $tariff)
			{
				if (!in_array($tariff->tariffCode, $requiredTariffCodes))
				{
					unset($responseTariffCodes[$k]);
				}
			}
		}

		if (!is_array($responseTariffCodes) || !count($responseTariffCodes))
		{
			throw new NoAvailableTariffsException;
		}

		return array_values($responseTariffCodes);
	}
}
