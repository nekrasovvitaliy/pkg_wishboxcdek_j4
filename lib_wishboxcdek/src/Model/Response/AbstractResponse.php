<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use WishboxCdekSDK2\Interface\ResponseInterface;

/**
 * @since 1.0.0
 */
class AbstractResponse implements ResponseInterface
{
	/**
	 * Формирует объект класса из ответа.
	 *
	 * @param   array|null  $properties  Properties
	 *
	 * @throws ReflectionException
	 *
	 * @since 1.0.0
	 */
	public function __construct(?array $properties = null)
	{
		if ($properties != null)
		{
			foreach ($properties as $key => $value)
			{
				$key = lcfirst($key);

				if (!property_exists($this, $key))
				{
					continue;
				}

				$propertyType = $this->getPropertyType($key);

				$isArray = false;

				if (mb_substr($propertyType, -2) == '[]')
				{
					$isArray = true;
					$propertyType = mb_substr($propertyType, 0, -2);
				}

				if (class_exists($propertyType))
				{
					if (!$isArray)
					{
						$reflectionClass = new ReflectionClass($propertyType);

						if ($reflectionClass->isEnum())
						{
							$this->{$key} = $propertyType::fromValue($value);
						}
						else
						{
							if (!is_array($value))
							{
								print_r($value);
								die;
							}

							$this->{$key} = $propertyType::create($value);
						}
					}
					else
					{
						foreach ($value as $valueItem)
						{
							$this->{$key}[] = $propertyType::create($valueItem);
						}
					}
				}
				else
				{
					$this->{$key} = $value;
				}
			}
		}
	}

	/**
	 * @param   string  $propertyName  Property name
	 *
	 * @return string
	 *
	 * @throws ReflectionException
	 *
	 * @since 1.0.0
	 */
	private function getPropertyType(string $propertyName): string
	{
		$reflectionProperty = new ReflectionProperty($this, $propertyName);
		$docComment = $reflectionProperty->getDocComment();

		$type = null;

		if (preg_match('/@var\s+(\S+)/', $docComment, $matches))
		{
			$type = $matches[1];
		}

		return str_replace('|null', '', $type);
	}

	/**
	 * @param   array  $properties  Properties
	 *
	 * @return static
	 *
	 * @throws ReflectionException
	 *
	 * @since 1.0.0
	 */
	public static function create(array $properties): static
	{
		return new static($properties);
	}
}
