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
class OfficeImageResponse extends AbstractResponse
{
	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $url;

	/**
	 * Получает ссылку на фото и преобразует ее в адрес фото.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getUrl(): string
	{
		return str_replace('edu.api-pvz.imageRepository.service.cdek.tech:8008', 'pvzimage.cdek.ru', $this->url);
	}
}
