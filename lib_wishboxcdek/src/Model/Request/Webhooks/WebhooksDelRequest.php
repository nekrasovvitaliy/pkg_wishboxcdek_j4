<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model\Request\Webhooks;

use WishboxCdekSDK2\Model\Request\AbstractRequest;

/**
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
class WebhooksDelRequest extends AbstractRequest
{
	/**
	 * Идентификатор вебхука
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $uuid;

	/**
	 * @param   string  $uuid  Uuid
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function setUuid(string $uuid): self
	{
		$this->uuid = $uuid;

		return $this;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
}
