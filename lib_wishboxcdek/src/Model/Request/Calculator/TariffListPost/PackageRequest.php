<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Calculator\TariffListPost;

use phpseclib3\Math\PrimeField\Integer;
use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 */
class PackageRequest extends AbstractRequest
{
	/**
	 * 8.1 Общий вес (в граммах)
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $weight;

	/**
	 * 8.2 Габариты упаковки. Длина (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $length = null;

	/**
	 * 8.3 Габариты упаковки. Ширина (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected ?int $width = null;

	/**
	 * 8.4 Габариты упаковки. Высота (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $height = null;

	/**
	 * 8.1 Общий вес (в граммах)
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 */
	public function getWeight(): int
	{
		return $this->weight;
	}

	/**
	 * 8.1 Общий вес (в граммах)
	 *
	 * @param   integer  $weight  Общий вес (в граммах)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setWeight(int $weight): self
	{
		$this->weight = $weight;

		return $this;
	}

	/**
	 * 8.2 Габариты упаковки. Длина (в сантиметрах)
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 */
	public function getLength(): int
	{
		return $this->length;
	}

	/**
	 * 8.2 Габариты упаковки. Длина (в сантиметрах)
	 *
	 * @param   integer|null  $length  Габариты упаковки. Длина (в сантиметрах)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setLength(?int $length): self
	{
		$this->length = $length;

		return $this;
	}

	/**
	 * 8.3 Габариты упаковки. Ширина (в сантиметрах)
	 *
	 * @return integer|null
	 *
	 * @since 1.0.0
	 *
	 */
	public function getWidth(): ?int
	{
		return $this->width;
	}

	/**
	 * 8.3 Габариты упаковки. Ширина (в сантиметрах)
	 *
	 * @param   integer|null  $width  Габариты упаковки. Ширина (в сантиметрах)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setWidth(?int $width): self
	{
		$this->width = $width;

		return $this;
	}

	/**
	 * 8.4 Габариты упаковки. Высота (в сантиметрах)
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 */
	public function getHeight(): int
	{
		return $this->height;
	}

	/**
	 * 8.4 Габариты упаковки. Высота (в сантиметрах)
	 *
	 * @param   integer|null  $height  Габариты упаковки. Высота (в сантиметрах)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setHeight(?int $height): self
	{
		$this->height = $height;

		return $this;
	}

	/**
	 * @param   integer  $weight  Общий вес (в граммах)
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	public static function withWeight(int $weight): self
	{
		$instance = new self;
		$instance->weight = $weight;

		return $instance;
	}
}
