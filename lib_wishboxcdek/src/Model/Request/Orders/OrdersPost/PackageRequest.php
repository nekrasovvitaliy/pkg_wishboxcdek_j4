<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 или позже
 */
namespace WishboxCdekSDK2\Model\Request\Orders\OrdersPost;

use WishboxCdekSDK2\Model\Request\AbstractRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPost\Package\ItemRequest;

/**
 * @since 1.0.0
 */
class PackageRequest extends AbstractRequest
{
	/**
	 * 20.1. Номер упаковки (можно использовать порядковый номер упаковки заказа или номер заказа), уникален в пределах
	 *      заказа. Идентификатор заказа в ИС Клиента
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $number;

	/**
	 * 20.2. Общий вес (в граммах)
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $weight;

	/**
	 * 20.3. Габариты упаковки. Длина (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $length = null;

	/**
	 * 20.4. Габариты упаковки. Ширина (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @example RU, DE, TR
	 *
	 * @since 1.0.0
	 */
	protected ?int $width = null;

	/**
	 * 20.5. Габариты упаковки. Высота (в сантиметрах)
	 *
	 * @var integer|null
	 *
	 * @since 1.0.0
	 */
	protected ?int $height = null;

	/**
	 * 20.6. Комментарий к упаковке
	 *       Обязательно и только для заказа типа "доставка"
	 *
	 * @var string|null
	 *
	 * @since 1.0.0
	 */
	protected ?string $comment = null;

	/**
	 * 20.7. Позиции товаров в упаковке
	 *       Только для заказов "интернет-магазин"
	 *       Максимум 126 уникальных позиций в заказе
	 *       Общее количество товаров в заказе может быть от 1 до 999999
	 *
	 * @var ItemRequest[]
	 *
	 * @since 1.0.0
	 */
	protected array $items;

	/**
	 * 20.1. Номер упаковки (можно использовать порядковый номер упаковки заказа или номер заказа), уникален в пределах
	 *      заказа. Идентификатор заказа в ИС Клиента
	 *
	 * @param   string  $number  Номер упаковки (можно использовать порядковый номер упаковки заказа или номер заказа),
	 *                           уникален в пределах заказа. Идентификатор заказа в ИС Клиента
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setNumber(string $number): self
	{
		$this->number = $number;

		return $this;
	}

	/**
	 * 20.2. Общий вес (в граммах)
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
	 * 20.3. Габариты упаковки. Длина (в сантиметрах)
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
	 * 20.4. Габариты упаковки. Ширина (в сантиметрах)
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
	 * 20.5. Габариты упаковки. Высота (в сантиметрах)
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
	 * 20.6. Комментарий к упаковке
	 *       Обязательно и только для заказа типа "доставка"
	 *
	 * @param   string|null  $comment  Комментарий к упаковке
	 *                                 Обязательно и только для заказа типа "доставка"
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setComment(?string $comment): self
	{
		$this->comment = $comment;

		return $this;
	}

	/**
	 * 20.7. Позиции товаров в упаковке
	 *       Только для заказов "интернет-магазин"
	 *       Максимум 126 уникальных позиций в заказе
	 *       Общее количество товаров в заказе может быть от 1 до 999999
	 *
	 * @param   ItemRequest[]  $items  Позиции товаров в упаковке
	 *                                 Только для заказов "интернет-магазин"
	 *                                 Максимум 126 уникальных позиций в заказе
	 *                                 Общее количество товаров в заказе может быть от 1 до 999999
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 */
	public function setItems(array $items): self
	{
		$this->items = $items;

		return $this;
	}
}
