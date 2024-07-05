<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Class Phone
 * Номер телефона (мобильный/городской).
 *
 * @since 1.0.0
 */
trait PhoneTrait
{
	use ExpressTrait;

	/**
	 * Номер телефона.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected $number;

	/**
	 * Добавочный номер
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected $additional;

	/**
	 * Устанавливает номер телефона.
	 *
	 * @param   string $number Номер телефона
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setNumber(string $number)
	{
		$this->number = $number;

		return $this;
	}

	/**
	 * Устанавливает добавочный номер
	 *
	 * @param   string $additional Добавочный номер
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public function setAdditional(string $additional)
	{
		$this->additional = $additional;

		return $this;
	}

	/**
	 * Получить параметр - номер телефона.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * Получить параметр - добавочный номер
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getAdditional()
	{
		return $this->additional;
	}
}
