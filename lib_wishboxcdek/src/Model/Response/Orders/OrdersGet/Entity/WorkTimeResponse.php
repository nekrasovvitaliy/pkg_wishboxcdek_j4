<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Response\Orders\OrdersGet\Entity;

use WishboxCdekSDK2\Model\Response\AbstractResponse;

/**
 * График работы ПВЗ.
 *
 * @since 1.0.0
 */
class WorkTimeResponse extends AbstractResponse
{
	/**
	 * Порядковый номер дня начиная с единицы. Понедельник = 1, воскресенье = 7.
	 *
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	protected int $day;

	/**
	 * Период работы в эти дни. Если в этот день не работают, то не отображается.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $time;

	/**
	 * Получить параметр - Порядковый номер дня начиная с единицы. Понедельник = 1, воскресенье = 7.
	 *
	 * @return integer
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getDay(): int
	{
		return $this->day;
	}

	/**
	 * Получить параметр - Период работы в эти дни. Если в этот день не работают, то не отображается.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getTime(): string
	{
		return $this->time;
	}
}
