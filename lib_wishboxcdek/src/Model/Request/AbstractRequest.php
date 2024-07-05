<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request;

use JsonSerializable;
use ReturnTypeWillChange;
use function array_filter;
use function get_object_vars;
use function is_null;
use function is_object;

/**
 * @since 1.0.0
 */
class AbstractRequest implements JsonSerializable
{
	/**
	 * Формирует массив параметров для запроса.
	 * Удаляет пустые значения.
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function prepareRequest(): array
	{
		$entityVars = get_object_vars($this);
		$dynamic = [];

		foreach ($entityVars as $key => $val)
		{
			if (is_null($this->{$key}))
			{
				continue;
			}

			if (!is_object($this->{$key}) && !is_array($this->{$key}))
			{
				$dynamic[$key] = $this->{$key};
			}
			elseif (is_array($this->{$key}))
			{
				foreach ($this->{$key} as $v)
				{
					if (is_object($v))
					{
						$arrayFromObject             = get_object_vars($v);
						$arrayFromObjectNullFiltered = array_filter($arrayFromObject);

						if (!empty($arrayFromObjectNullFiltered))
						{
							$dynamic[$key][] = $arrayFromObjectNullFiltered;
						}
					}
					else
					{
						$dynamic[$key] = $this->{$key};
					}
				}
			}
			else
			{
				$a = get_object_vars($this->{$key});
				$dynamic[$key] = array_filter(
					$a,
					function ($value)
					{
						return $value !== null;
					}
				);
			}
		}

		return $dynamic;
	}

	/**
	 * @return array
	 *
	 * @since 1.0.0
	 */
	#[ReturnTypeWillChange]
	public function jsonSerialize(): array
	{
		return get_object_vars($this);
	}
}
