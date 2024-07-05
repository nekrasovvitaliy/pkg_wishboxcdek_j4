<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Координаты местоположения (широта) в градусах
 *
 * @since 1.0.0
 */
trait LatitudeOptionalTrait
{
	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $latitude = null;

	/**
	 * Координаты местоположения (широта) в градусах
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getLatitude(): ?float
	{
		return $this->latitude;
	}
}
