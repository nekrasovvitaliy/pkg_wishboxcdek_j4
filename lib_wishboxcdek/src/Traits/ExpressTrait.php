<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Traits;

trait ExpressTrait
{
	/**
	 * Экспресс-метод установки параметов.
	 */
	public static function express(array $args)
	{
		$instance = new self;

		foreach ($args as $key => $value)
		{
			if (!\is_null($value))
			{
				$instance->{$key} = $value;
			}
		}

		return $instance;
	}
}
