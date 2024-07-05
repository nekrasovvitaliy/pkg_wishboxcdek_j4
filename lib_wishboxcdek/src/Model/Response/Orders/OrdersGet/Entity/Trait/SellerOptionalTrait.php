<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Trait;

use WishboxCdekSDK2\Entity\Responses\SellerResponse;

/**
 * Реквизиты истинного продавца
 *
 * @since 1.0.0
 */
trait SellerOptionalTrait
{
	/**
	 * Реквизиты истинного продавца
	 *
	 * @var SellerResponse|null
	 *
	 * @since 1.0.0
	 */
	protected ?SellerResponse $seller; // phpcs:ignore

	/**
	 * Реквизиты истинного продавца
	 *
	 * @return SellerResponse|null
	 *
	 * @since 1.0.0
	 */
	public function getSeller(): ?SellerResponse
	{
		return $this->seller; // phpcs:ignore
	}

	/**
	 * Реквизиты истинного продавца
	 *
	 * @param   SellerResponse  $seller  Реквизиты истинного продавца
	 *
	 * @return static
	 *
	 * @since 1.0.0
	 */
	public function setSeller(SellerResponse $seller): static
	{
		$this->seller = $seller; // phpcs:ignore

		return $this;
	}
}
