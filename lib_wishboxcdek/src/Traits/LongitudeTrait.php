<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Координаты местоположения (долгота) в градусах
 *
 * @since 1.0.0
 */
trait LongitudeTrait
{
	/**
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $longitude;

	/**
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getLongitude(): float
	{
		return $this->longitude;
	}
}
