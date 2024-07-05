<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity\Location\Trait;

/**
 * Код города ФИАС
 *
 * @since 1.0.0
 */
trait FiasGuidOptionalTrait
{
	/**
	 * Код города ФИАС
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $fias_guid = null; // phpcs:ignore

	/**
	 * Код города ФИАС
	 *
	 * @return string|null
	 *
	 * @since 1.0.0
	 */
	public function getFiasGuid(): ?string
	{
		return $this->fias_guid; // phpcs:ignore
	}
}
