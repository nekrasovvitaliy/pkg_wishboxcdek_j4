<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxcdek\Site\Entity;

use http\Exception\InvalidArgumentException;

/**
 * @since 1.0.0
 */
class ProductEntity
{
	/**
	 * @var string $name Name
	 *
	 * @since 1.0.0
	 */
	public string $name;

	/**
	 * @var string $code Code
	 *
	 * @since 1.0.0
	 */
	public string $code;

	/**
	 * @var float $price Price
	 *
	 * @since 1.0.0
	 */
	public float $price;

	/**
	 * @var float $payment Payment
	 *
	 * @since 1.0.0
	 */
	public float $payment;

	/**
	 * @var float $cost Cost
	 *
	 * @since 1.0.0
	 */
	public float $cost;

	/**
	 * @var integer $weight Weight in grams
	 *
	 * @since 1.0.0
	 */
	public int $weight;

	/**
	 * @var integer $quantity Quantity
	 *
	 * @since 1.0.0
	 */
	public int $quantity;

	/**
	 * @param   string   $name      Name
	 * @param   string   $code      Code
	 * @param   float    $price     Price
	 * @param   float    $payment   Payment
	 * @param   float    $cost      Cost
	 * @param   integer  $weight    Weight in grams
	 * @param   integer  $quantity  Quantity
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		string $name,
		string $code,
		float $price,
		float $payment,
		float $cost,
		int $weight,
		int $quantity
	)
	{
		if (empty($code))
		{
			throw new InvalidArgumentException('$code param must not be empty');
		}

		$this->name = $name;
		$this->code = $code;
		$this->price = $price;
		$this->payment = $payment;
		$this->cost = $cost;
		$this->weight = $weight;
		$this->quantity = $quantity;
	}
}
