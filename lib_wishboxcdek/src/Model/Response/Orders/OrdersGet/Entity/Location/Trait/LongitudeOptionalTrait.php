<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Координаты местоположения (долгота) в градусах
 *
 * @since 1.0.0
 */
trait LongitudeOptionalTrait
{
	/**
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @var float|null
	 *
	 * @since 1.0.0
	 */
	protected ?float $longitude = null;

	/**
	 * Координаты местоположения (долгота) в градусах
	 *
	 * @return float|null
	 *
	 * @since 1.0.0
	 */
	public function getLongitude(): ?float
	{
		return $this->longitude;
	}
}
