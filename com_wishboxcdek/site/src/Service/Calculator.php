<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace Joomla\Component\Wishboxcdek\Site\Service;

use Exception;
use InvalidArgumentException;
use Joomla\CMS\Factory;
use Joomla\Component\Wishboxcdek\Administrator\Table\TariffTable;
use Joomla\Component\Wishboxcdek\Site\Exception\NoAvailableTariffsException;
use Joomla\Component\Wishboxcdek\Site\Interface\CalculatorDelegateInterface;
use Joomla\Component\Wishboxcdek\Site\Service\RequestCreator\TariffListPostRequestCreator;
use Joomla\Component\Wishboxcdek\Site\Trait\ApiClientTrait;
use Joomla\Database\DatabaseDriver;
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
	 * @param   CalculatorDelegateInterface  $delegate  Delegate
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
	 * @return ShippingTariff[]
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function getShippingTariffs(): array
	{
		$shippingTariffs = [];

		$tariffs = $this->getTariffs();

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
		$app = Factory::getApplication();
		$tariffListPostRequestCreator = new TariffListPostRequestCreator($this->delegate);
		$tariffListPostRequest = $tariffListPostRequestCreator->getRequest();

		$receiverCityCode = $this->delegate->getReceiverCityCode();

		if (!$receiverCityCode)
		{
			return [];
		}

		$apiClient = $this->getApiClient();

		$tariffListPostResponse = $apiClient->calculateTariffList($tariffListPostRequest);
		$responseTariffCodes = $tariffListPostResponse->getTariffCodes();

		$requiredTariffCodes = $this->delegate->getTariffCodes();

		if (is_array($responseTariffCodes) && count($responseTariffCodes))
		{
			/** @var DatabaseDriver $db */
			$db = Factory::getContainer()->get(DatabaseDriver::class);
			$query = $db->getQuery(true)
				->select('id')
				->from('#__wishboxcdek_tariffs');
			$db->setQuery($query);
			$tariffCodes = $db->loadColumn();

			$query = $db->getQuery(true)
				->select('code')
				->from('#__wishboxcdek_tariff_modes');
			$db->setQuery($query);
			$tariffModes = $db->loadColumn();

			foreach ($responseTariffCodes as $tariff)
			{
				if (!in_array($tariff->getTariffCode(), $tariffCodes))
				{
					/** @var TariffTable $tariffTable */
					$tariffTable = $app->bootComponent('com_wishboxcdek')
						->getMVCFactory()
						->createTable('Tariff', 'Administrator');

					$tariffTable->code = $tariff->getTariffCode();
					$tariffTable->published = 1;
					$tariffTable->name = $tariff->getTariffName();
					$tariffTable->mode = $tariff->getDeliveryMode();
					$tariffTable->weight_limit = ''; // phpcs:ignore
					$tariffTable->service = '';
					$tariffTable->description = $tariff->getTariffDescription();
					$tariffTable->store();
				}

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
