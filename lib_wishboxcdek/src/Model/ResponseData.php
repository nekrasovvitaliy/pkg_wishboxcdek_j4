<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Model;

/**
 * Ошибки, возникшие в ходе выполнения запроса
 *
 * @since 1.0.0
 */
class ResponseData
{
	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected array $headers;

	/**
	 * @var string
	 *
	 * @since 1.0.0
	 */
	protected string $body;

	/**
	 * @param   string  $code     Code
	 * @param   array   $headers  Headers
	 * @param   string  $body     Body
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $code, array $headers, string $body)
	{
		$this->code = $code;
		$this->headers = $headers;
		$this->body = $body;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public function getHeaders(): array
	{
		return $this->headers;
	}

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function getBody(): string
	{
		return $this->body;
	}
}
