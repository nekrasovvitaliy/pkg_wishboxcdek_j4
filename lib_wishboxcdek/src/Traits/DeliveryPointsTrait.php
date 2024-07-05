<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * @since 1.0.0
 */
trait DeliveryPointsTrait
{
	/**
	 * Есть терминал оплаты.
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected $have_cashless;

	/**
	 * Есть приём наличных.
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected $have_cash;

	/**
	 * Разрешен наложенный платеж в ПВЗ.
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected $allowed_cod;

	/**
	 * Есть ли примерочная.
	 *
	 * @var boolean|null
	 *
	 * @since 1.0.0
	 */
	protected $is_dressing_room;

	/**
	 * Является пунктом выдачи.
	 *
	 * @var boolean|null
	 */
	protected $is_handout;

	/**
	 * Есть ли в офисе приём заказов.
	 *
	 * @var boolean|null
	 */
	protected $is_reception;

	/**
	 * Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax).
	 *
	 * @var integer|null
	 */
	protected $weight_max;

	/**
	 * Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin).
	 *
	 * @var integer|null
	 */
	protected $weight_min;

	/**
	 * Является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов.
	 *
	 * @var boolean|null
	 */
	protected $take_only;

	/**
	 * Получение параметра - есть терминал оплаты.
	 *
	 * @return boolean|null
	 */
	public function getHaveCashless()
	{
		return $this->have_cashless;
	}

	/**
	 * Установка параметра - есть терминал оплаты.
	 *
	 * @param   bool|null $have_cashless есть терминал оплаты
	 *
	 * @return self
	 */
	public function setHaveCashless($have_cashless)
	{
		$this->have_cashless = $have_cashless;

		return $this;
	}

	/**
	 * Получение параметра - есть приём наличных.
	 *
	 * @return boolean|null
	 */
	public function getHaveCash()
	{
		return $this->have_cash;
	}

	/**
	 * Установка параметра - есть приём наличных.
	 *
	 * @param   bool|null $have_cash есть приём наличных
	 *
	 * @return self
	 */
	public function setHaveCash($have_cash)
	{
		$this->have_cash = $have_cash;

		return $this;
	}

	/**
	 * Получение параметра - разрешен наложенный платеж в ПВЗ.
	 *
	 * @return boolean|null
	 */
	public function getAllowedCod()
	{
		return $this->allowed_cod;
	}

	/**
	 * Установка параметра - разрешен наложенный платеж в ПВЗ.
	 *
	 * @param   bool|null $allowed_cod разрешен наложенный платеж в ПВЗ
	 *
	 * @return self
	 */
	public function setAllowedCod($allowed_cod)
	{
		$this->allowed_cod = $allowed_cod;

		return $this;
	}

	/**
	 * Получение параметра - есть ли примерочная.
	 *
	 * @return boolean|null
	 */
	public function getIsDressingRoom()
	{
		return $this->is_dressing_room;
	}

	/**
	 * Установка параметра - есть ли примерочная.
	 *
	 * @param   bool|null $is_dressing_room есть ли примерочная
	 *
	 * @return self
	 */
	public function setIsDressingRoom($is_dressing_room)
	{
		$this->is_dressing_room = $is_dressing_room;

		return $this;
	}

	/**
	 * Получение параметра - является пунктом выдачи.
	 *
	 * @return boolean|null
	 */
	public function getIsHandout()
	{
		return $this->is_handout;
	}

	/**
	 * Установка параметра - является пунктом выдачи.
	 *
	 * @param   bool|null $is_handout является пунктом выдачи
	 *
	 * @return self
	 */
	public function setIsHandout($is_handout)
	{
		$this->is_handout = $is_handout;

		return $this;
	}

	/**
	 * Получение параметра - есть ли в офисе приём заказов.
	 *
	 * @return boolean|null
	 */
	public function getIsReception()
	{
		return $this->is_reception;
	}

	/**
	 * Установка параметра - есть ли в офисе приём заказов.
	 *
	 * @param   bool|null $is_reception есть ли в офисе приём заказов
	 *
	 * @return self
	 */
	public function setIsReception($is_reception)
	{
		$this->is_reception = $is_reception;

		return $this;
	}

	/**
	 * Получение параметра - максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax).
	 *
	 * @return integer|null
	 */
	public function getWeightMax()
	{
		return $this->weight_max;
	}

	/**
	 * Установка параметра - максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax).
	 *
	 * @param   int|null $weight_max Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax).
	 *
	 * @return self
	 */
	public function setWeightMax($weight_max)
	{
		$this->weight_max = $weight_max;

		return $this;
	}

	/**
	 * Получение параметра - минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin).
	 *
	 * @return integer|null
	 */
	public function getWeightMin()
	{
		return $this->weight_min;
	}

	/**
	 * Установка параметра - минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin).
	 *
	 * @param   int|null $weight_min Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin).
	 *
	 * @return self
	 */
	public function setWeightMin($weight_min)
	{
		$this->weight_min = $weight_min;

		return $this;
	}

	/**
	 * Получение параметра - является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов.
	 *
	 * @return boolean|null
	 */
	public function getTakeOnly()
	{
		return $this->take_only;
	}

	/**
	 * Установка параметра - является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов.
	 *
	 * @param   bool|null $take_only является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов
	 *
	 * @return self
	 */
	public function setTakeOnly($take_only)
	{
		$this->take_only = $take_only;

		return $this;
	}
}
