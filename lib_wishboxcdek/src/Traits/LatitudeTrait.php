<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

/**
 * Координаты местоположения (широта) в градусах
 *
 * @since 1.0.0
 */
trait LatitudeTrait
{
	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $latitude;

	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 */
	public function getLatitude(): float
	{
		return $this->latitude;
	}
}
