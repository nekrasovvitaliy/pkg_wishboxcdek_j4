<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

use WishboxCdekSDK2\Constants;
use WishboxCdekSDK2\Traits\DeliveryPointsTrait;
use WishboxCdekSDK2\Traits\LocationTrait;

/**
 * Список действующих офисов СДЭК.
 *
 * @since 1.0.0
 */
class DeliveryPoints extends Location
{
	use LocationTrait;
	use DeliveryPointsTrait;

	public const TYPE_PVZ = 'PVZ';
	public const TYPE_ALL = 'ALL';
	public const TYPE_POSTOMAT = 'POSTOMAT';

	public const LANGUAGE_RUSSIAN = 'rus';
	public const LANGUAGE_ENGLISH = 'eng';
	public const LANGUAGE_CHINESE = 'zho';

	/**
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	public ?string $type;

	/**
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->pattern = Constants::DELIVERY_POINTS_FILTER;
	}

	/**
	 * @param   string  $type  Type
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setType(string $type): self
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * @param   integer  $cityCode  City code
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCityCode(int $cityCode): self
	{
		$this->city_code = $cityCode; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   boolean  $haveCashless  Have cashless
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCashless(bool $haveCashless): self
	{
		$this->have_cashless = $haveCashless; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   boolean  $haveCash  Have cash
	 *
	 * @return $this
	 *
	 * @since 1.0.0
	 */
	public function setCash(bool $haveCash): self
	{
		$this->have_cash = $haveCash; // phpcs:ignore

		return $this;
	}

	/**
	 * 9. Наличие примерочной, может принимать значения:
	 * «1», «true» - есть;
	 * «0», «false» - нет.
	 *
	 * @param   boolean|null  $isDressingRoom  Is the dressing room?
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setDressingRoom(?bool $isDressingRoom): self
	{
		$this->is_dressing_room = $isDressingRoom; // phpcs:ignore

		return $this;
	}

	/**
	 * Является пунктом выдачи, может принимать значения:
	 * «1», «true» - да;
	 * «0», «false» - нет.
	 *
	 * @param   boolean  $isHandout  Is handout
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setHandout(bool $isHandout): self
	{
		$this->is_handout = $isHandout; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   boolean|null  $isReception  Is reception
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setReception(?bool $isReception): self
	{
		$this->is_reception = $isReception; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   boolean $allowedCod  Allowed cod
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setCodAllowed(bool $allowedCod): self
	{
		$this->allowed_cod = $allowedCod; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   float  $weightMax  Weight max
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setMaxWeight(float $weightMax): self
	{
		$this->weight_max = $weightMax; // phpcs:ignore

		return $this;
	}

	/**
	 * @param   string  $lang Lang
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setLanguage(string $lang = self::LANGUAGE_RUSSIAN): self
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * @param   boolean  $takeOnly  Take only
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setPickupOnly(bool $takeOnly): self
	{
		$this->take_only = $takeOnly;  // phpcs:ignore

		return $this;
	}

	/**
	 * Get код ПВЗ.
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getCode(): ?string
	{
		return $this->code;
	}
}
