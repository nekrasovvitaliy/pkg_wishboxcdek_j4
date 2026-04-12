<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\WishboxCdek\Site\Model;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactoryAwareInterface;
use Joomla\Component\WishboxCdek\Administrator\Factory\RequestFactoryAwareTrait;
use Joomla\Component\WishboxCdek\Site\Exception\NoAvailableTariffsException;
use Joomla\Component\WishboxCdek\Site\Interface\CalculatorDelegateInterface;
use Wishbox\ShippingService\ShippingTariff;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareInterface;
use WishboxCdekSDK2\Factory\CdekClientV2FactoryAwareTrait;
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
class CalculatorModel extends BaseDatabaseModel implements RequestFactoryAwareInterface, CdekClientV2FactoryAwareInterface
{
	use CdekClientV2FactoryAwareTrait;
	use RequestFactoryAwareTrait;

	/**
	 * @var array $tariffs
	 *
	 * @since 1.0.0
	 */
	protected static array $tariffs;

	/**
	 * Returns shipping price
	 *
	 * @param   CalculatorDelegateInterface  $delegate
	 *
	 * @return ShippingTariff|null
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getTariff(CalculatorDelegateInterface $delegate): ?ShippingTariff
	{
		$shippingTariff = $this->getShippingTariff($delegate);

		self::$tariffs[$delegate->getShippingMethodId()] = $shippingTariff;

		return $shippingTariff;
	}

	/**
	 * @return ShippingTariff[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getShippingTariffs(CalculatorDelegateInterface $delegate): array
	{
		$shippingTariffs = [];

		$tariffs = $this->getTariffs($delegate);

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
	 * @param   CalculatorDelegateInterface  $delegate
	 *
	 * @return ShippingTariff
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getShippingTariff(CalculatorDelegateInterface $delegate): ShippingTariff
	{
		$shippingTariff = new ShippingTariff(0, 0);
		$tariffs = $this->getTariffs($delegate);

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
	 * @param   CalculatorDelegateInterface  $delegate
	 *
	 * @return array
	 *
	 * @throws NoAvailableTariffsException
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	private function getTariffs(CalculatorDelegateInterface $delegate): array
	{
		$tariffListPostRequest = $this->getRequestFactory()->createTariffListPostRequest($delegate);

		$receiverCityCode = $delegate->getReceiverCityCode();

		if (!$receiverCityCode)
		{
			return [];
		}

		$apiClient = $this->getCdekClientV2Factory()->getDefaultClient();

		$tariffListPostResponse = $apiClient->calculateTariffList($tariffListPostRequest);
		$responseTariffCodes = $tariffListPostResponse->getTariffCodes();

		$requiredTariffCodes = $delegate->getTariffCodes();

		if (is_array($responseTariffCodes) && count($responseTariffCodes))
		{
			$db = $this->getDatabase();

			$query = $db->createQuery()
				->select($db->qn('code'))
				->from($db->qn('#__wishboxcdek_tariff_modes'));
			$db->setQuery($query);
			$tariffModes = $db->loadColumn();

			foreach ($responseTariffCodes as $tariff)
			{
				if (!in_array($tariff->getDeliveryMode(), $tariffModes))
				{
					throw new Exception('Delivery mode not found', 500);
				}
			}
		}

		if (is_array($responseTariffCodes) && count($responseTariffCodes))
		{
			foreach ($responseTariffCodes as $k => $tariff)
			{
				if (!in_array($tariff->getTariffCode(), $requiredTariffCodes))
				{
					unset($responseTariffCodes[$k]);
				}
			}
		}

		if (!is_array($responseTariffCodes) || !count($responseTariffCodes))
		{
			throw new NoAvailableTariffsException;
		}

		if (is_array($responseTariffCodes))
		{
			return array_values($responseTariffCodes);
		}

		return [];
	}
}
