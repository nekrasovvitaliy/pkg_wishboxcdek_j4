<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPoint;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * @since 1.0.0
 */
class DimensionsResponse extends AbstractResponse
{
	/**
	 * 30.1. Ширина (см)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $width;

	/**
	 * 30.2. Высота (см)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $height;

	/**
	 * 30.3 Глубина (см)
	 *
	 * @var float
	 *
	 * @since 1.0.0
	 */
	protected float $depth;

	/**
	 * 30.1. Ширина (см)
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getWidth(): float
	{
		return $this->width;
	}

	/**
	 * 30.2. Высота (см)
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getHeight(): float
	{
		return $this->height;
	}

	/**
	 * 30.3 Глубина (см)
	 *
	 * @return float
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDepth(): float
	{
		return $this->depth;
	}
}
