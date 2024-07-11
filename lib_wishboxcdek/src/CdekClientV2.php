<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Cache\Controller\CallbackController;
use Joomla\CMS\Factory;
use Joomla\Http\Response as HttpResponse;
use Joomla\Uri\Uri;
use Psr\Http\Message\StreamInterface;
use Joomla\CMS\Http\Http;
use Joomla\CMS\Http\HttpFactory;
use WishboxCdekSDK2\Exception\Api\RequestError\EntityNotFoundImNumberException;
use WishboxCdekSDK2\Factory\ResponsePipelineFactory;
use WishboxCdekSDK2\Interface\ResponseInterface;
use WishboxCdekSDK2\Model\Request\Calculator\TariffListPostRequest;
use WishboxCdekSDK2\Model\Request\DeliveryPoints\DeliveryPointsGetRequest;
use WishboxCdekSDK2\Model\Request\Location\CitiesGetRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPatchRequest;
use WishboxCdekSDK2\Model\Request\Orders\OrdersPostRequest;
use WishboxCdekSDK2\Model\Response\Calculator\TariffListPostResponse;
use WishboxCdekSDK2\Model\Response\DeliveryPoints\DeliveryPointsGet\DeliveryPointResponse;
use WishboxCdekSDK2\Model\Response\Location\CitiesGet\CityResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersGetResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPatchResponse;
use WishboxCdekSDK2\Model\Response\Orders\OrdersPostResponse;
use WishboxCdekSDK2\Model\ResponseData;

/**
 * Class CdekClientV2 - клиент взаимодействия с api cdek 2.0.
 *
 * @since 1.0.0
 */
final class CdekClientV2
{
	/**
	 * Аккаунт сервиса интеграции.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $account;

	/**
	 * Тип аккаунта.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $accountType;

	/**
	 * Секретный пароль сервиса интеграции.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $secure;

	/**
	 * Authorization: Bearer Токен.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $token;

	/**
	 * Настройки массив сохранения.
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	private array $memory = [];

	/**
	 * @var Http
	 *
	 * @since 1.0.0
	 */
	private Http $http;

	/**
	 * Конструктор клиента Guzzle.
	 *
	 * @param   string       $account  Логин Account в сервисе Интеграции
	 * @param   string|null  $secure   Пароль Secure password в сервисе Интеграции
	 * @param   float|null   $timeout  Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0
	 *                                 ждать бесконечно долго (поведение по умолчанию)
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $account, ?string $secure = null, ?float $timeout = 10.0)
	{
		$this->http = HttpFactory::getHttp(
			[
				'timeout' => $timeout,
				'http_errors' => false,
			]
		);

		if ($account == 'TEST')
		{
			$this->account = Constants::TEST_ACCOUNT;
			$this->secure = Constants::TEST_SECURE;
			$this->accountType = 'TEST';
		}
		else
		{
			$this->account = $account;
			$this->secure = $secure;
			$this->accountType = 'COMBAT';
		}
	}

	/**
	 * Метод используется для расчета стоимости и сроков доставки по всем доступным тарифам.
	 *
	 * @param   TariffListPostRequest  $request  Объект класса Tariff установки запроса для тарифа
	 *
	 * @return TariffListPostResponse
	 *
	 * @since 1.0.0
	 *
	 */
	public function calculateTariffList(TariffListPostRequest $request): TariffListPostResponse
	{
		/** @var TariffListPostResponse $response */
		$response = $this->getResponse(
			Constants::CALC_TARIFFLIST_URL,
			TariffListPostResponse::class,
			$request->prepareRequest()
		);

		return $response;
	}

	/**
	 * @param   string      $path    Path
	 * @param   array|null  $data    Data
	 * @param   string      $method  Method
	 *
	 * @return ResponseData
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	public function getResponseData(string $path, array $data = null, string $method = 'POST'): ResponseData
	{
		$response = $this->getHttpResponse($path, $data, $method);

		$responseData = new ResponseData(
			$response->code,
			$response->headers,
			$response->body
		);

		return $responseData;
	}

	/**
	 * Выполняет вызов к API.
	 *
	 * @param   string   $type    Метод запроса
	 * @param   null     $params  Массив данных параметров запроса
	 * @param   string   $method  URL path запроса
	 *
	 * @return HttpResponse|StreamInterface
	 *
	 * @since 1.0.0
	 */
	private function getHttpResponse(
		string $type,
		$params = null,
		string $method = 'POST'
	): HttpResponse|StreamInterface
	{
		if (!$this->checkSavedToken())
		{
			$this->authorize();
		}

		// Проверяем является ли запрос на файл pdf
		$isPdfFileRequest = strpos($type, '.pdf');

		if ($isPdfFileRequest !== false)
		{
			$headers['Accept'] = 'application/pdf';
		}
		else
		{
			$headers['Accept'] = 'application/json';
			$headers['Content-Type'] = 'application/json';
		}

		$headers['Authorization'] = 'Bearer ' . $this->token;

		if (!empty($params) && is_object($params))
		{
			$params = $params->prepareRequest();
		}

		$url = ($this->account == 'TEST' ? Constants::API_URL_TEST : Constants::API_URL) . $type;
		$uri = new Uri($url);

		$response = null;

		switch ($method)
		{
			case 'GET':
				if (!empty($params))
				{
					foreach ($params as $name => $value)
					{
						$uri->setVar($name, $value);
					}
				}

				$response = $this->http->get($uri, $headers);
				break;
			case 'DELETE':
				$response = $this->http->delete($url, $headers, null, $params);
				break;
			case 'POST':
				$response = $this->http->post($url, json_encode($params), $headers);
				break;
			case 'PATCH':
				$response = $this->http->patch($url, json_encode($params), $headers);
				break;
		}

		// Если запрос на файл pdf был успешным сразу отправляем его в ответ
		if ($isPdfFileRequest)
		{
			if ($response->getStatusCode() == 200)
			{
				if (str_contains($response->getHeader('Content-Type')[0], 'application/pdf'))
				{
					return $response->getBody();
				}
			}
		}

		return $response;
	}

	/**
	 * Авторизация клиента в сервисе Интеграции.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	private function authorize(): void
	{
		$data = [
			Constants::AUTH_KEY_TYPE        => Constants::AUTH_PARAM_CREDENTIAL,
			Constants::AUTH_KEY_CLIENT_ID   => $this->account,
			Constants::AUTH_KEY_SECRET      => $this->secure,
		];
		$headers['Content-Type'] = 'application/x-www-form-urlencoded';

		$response = $this->http->post(
			($this->account == 'TEST' ? Constants::API_URL_TEST : Constants::API_URL) . Constants::OAUTH_URL,
			$data,
			$headers
		);

		$responseData = new ResponseData($response->code, $response->headers, $response->body);

		$handler = ResponsePipelineFactory::createDefaultPipeline();
		$handler->handle(Constants::OAUTH_URL, $responseData);

		$tokenInfo   = json_decode($response->getBody(), true);
		$this->token = $tokenInfo['access_token'] ?? '';
	}

	/**
	 * Проверяет, соответствует ли переданный массив сохраненный данных авторизации требованиям
	 *
	 * @return boolean
	 *
	 * @since 1.0.0
	 */
	private function checkSavedToken(): bool
	{
		$checkMemory = $this->getMemory();

		// Если не передан верный сохраненный массив данных для авторизации, функция возвратит false

		if (!isset($checkMemory['account_type'])
			|| empty($checkMemory)
			|| !isset($checkMemory['expires_in'])
			|| !isset($checkMemory['access_token']))
		{
			return false;
		}

		// Если не передан верный сохраненный массив данных для авторизации,
		// но тип аккаунта не тот, который был при прошлой сохраненной авторизации - функция возвратит false
		if ($checkMemory['account_type'] !== $this->accountType)
		{
			return false;
		}

		return $checkMemory['expires_in'] > time()
			&& !empty($checkMemory['access_token'])
			&& $this->setToken($checkMemory['access_token']);
	}

	/**
	 * Проверяет передан ли сохраненный массив данных авторизации.
	 *
	 * @return array|null
	 *
	 * @since 1.0.0
	 */
	private function getMemory(): ?array
	{
		return $this->memory;
	}

	/**
	 * Устанавливает токен из данных авторизации сервера или из переданной памяти.
	 *
	 * @param   string  $token  Token
	 *
	 * @return self
	 *
	 * @since 1.0.0
	 */
	private function setToken(string $token): self
	{
		$this->token = $token;

		return $this;
	}

	/**
	 * Проверка ответа на ошибки.
	 *
	 * @param   string        $path          Path
	 * @param   ResponseData  $responseData  Response
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	private function handleErrors(string $path, ResponseData $responseData): void
	{
		$handler = ResponsePipelineFactory::createDefaultPipeline();
		$handler->handle($path, $responseData);
	}

	/**
	 * Получение списка городов.
	 *
	 * @param   CitiesGetRequest|null  $request  Filter
	 *
	 * @return CityResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getCities(?CitiesGetRequest $request = null): array
	{
		/** @var CityResponse[] $responseArray */
		$responseArray = $this->getResponseArray(
			Constants::CITIES_URL,
			CityResponse::class,
			$request->prepareRequest(),
			'GET',
			true
		);

		return $responseArray;
	}

	/**
	 * Получение списка ПВЗ СДЭК.
	 *
	 * @param   DeliveryPointsGetRequest|null  $request  Filter
	 *
	 * @return DeliveryPointResponse[]
	 *
	 * @since 1.0.0
	 */
	public function getDeliveryPoints(?DeliveryPointsGetRequest $request = null): array
	{
		/** @var DeliveryPointResponse[] $response */
		$response = $this->getResponseArray(
			Constants::DELIVERY_POINTS_URL,
			DeliveryPointResponse::class,
			$request->prepareRequest(),
			'GET',
			true
		);

		return $response;
	}

	/**
	 * Создание заказа.
	 *
	 * @param   OrdersPostRequest  $request  Параметры заказа
	 *
	 * @return OrdersPostResponse
	 *
	 * @since 1.0.0
	 */
	public function createOrder(OrdersPostRequest $request): OrdersPostResponse
	{
		/** @var OrdersPostResponse $response */
		$response = $this->getResponse(
			Constants::ORDERS_URL,
			OrdersPostResponse::class,
			$request->prepareRequest(),
			'POST',
			true
		);

		return $response;
	}

	/**
	 * Обновление заказа.
	 *
	 * @param   OrdersPatchRequest  $request  Параметры заказа
	 *
	 * @return OrdersPatchResponse
	 *
	 * @since 1.0.0
	 */
	public function updateOrder(OrdersPatchRequest $request): OrdersPatchResponse
	{
		/** @var OrdersPatchResponse $response */
		$response = $this->getResponse(
			Constants::ORDERS_URL,
			OrdersPatchResponse::class,
			$request->prepareRequest(),
			'PATCH',
			false
		);

		return $response;
	}

	/**
	 * Полная информация о заказе по трек номеру.
	 *
	 * @param   string  $cdekNumber  Номер заказа(накладной) СДЭК
	 *
	 * @return OrdersGetResponse
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOrderInfoByCdekNumber(string $cdekNumber): OrdersGetResponse
	{
		/** @var OrdersGetResponse $response */
		$response = $this->getResponse(
			Constants::ORDERS_URL,
			OrdersGetResponse::class,
			['cdek_number' => $cdekNumber],
			'GET'
		);

		return $response;
	}

	/**
	 * Полная информация о заказе по ID заказа в магазине.
	 *
	 * @param   string  $imNumber  Номер заказа
	 *
	 * @return OrdersGetResponse
	 *
	 * @throws EntityNotFoundImNumberException
	 *
	 * @since 1.0.0
	 */
	public function getOrderInfoByImNumber(string $imNumber): OrdersGetResponse
	{
		/** @var OrdersGetResponse $response */
		$response = $this->getResponse(
			Constants::ORDERS_URL,
			OrdersGetResponse::class,
			['im_number' => $imNumber],
			'GET'
		);

		return $response;
	}

	/**
	 * Полная информация о заказе по ID заказа в магазине.
	 *
	 * @param   string  $uuid  Идентификатор сущности, связанной с заказом
	 *
	 * @return OrdersGetResponse
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function getOrderInfoByUuid(string $uuid): OrdersGetResponse
	{
		/** @var OrdersGetResponse $response */
		$response = $this->getResponse(
			Constants::ORDERS_URL . '/' . $uuid,
			OrdersGetResponse::class,
			null,
			'GET'
		);

		return $response;
	}

	/**
	 * @param   string       $path     Path
	 * @param   string       $type     Type
	 * @param   array|null   $data     Data
	 * @param   string       $method   Method
	 * @param   boolean      $cashing  Cashing
	 *
	 * @return ResponseInterface|array
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	private function getResponse(
		string $path,
		string $type,
		array $data = null,
		string $method = 'POST',
		bool $cashing = false
	): ResponseInterface|array
	{
		/** @var CallbackController $cacheController */
		$cacheController = Factory::getContainer()
			->get(CacheControllerFactoryInterface::class)
			->createCacheController(
				'callback',
				[
					'caching' => (int) $cashing
				]
			);

		/** @var ResponseData $responseData */
		$responseData = $cacheController->get(
			[$this, 'getResponseData'],
			[$path, $data, $method],
		);

		$this->handleErrors($path, $responseData);

		/** @var ResponseInterface $response */
		$response = new $type(json_decode($responseData->getBody(), true));

		return $response;
	}

	/**
	 * @param   string       $path     Path
	 * @param   string       $type     Type
	 * @param   array|null   $data     Data
	 * @param   string       $method   Method
	 * @param   boolean      $cashing  Cashing
	 *
	 * @return ResponseInterface[]
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnnecessaryLocalVariableInspection
	 */
	private function getResponseArray(
		string $path,
		string $type,
		array $data = null,
		string $method = 'POST',
		bool $cashing = false
	): array
	{
		/** @var CallbackController $cacheController */
		$cacheController = Factory::getContainer()
			->get(CacheControllerFactoryInterface::class)
			->createCacheController(
				'callback',
				[
					'caching' => (int) $cashing
				]
			);

		/** @var ResponseData $data */
		$data = $cacheController->get(
			[$this, 'getResponseData'],
			[$path, $type, $data, $method],
		);

		$responseArray = [];

		foreach ($data as $item)
		{
			$responseArray[] = new $type($item);
		}

		return $responseArray;
	}
}
