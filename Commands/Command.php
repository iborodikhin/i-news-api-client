<?php
namespace Api\Commands;

use Api\Api;
use Api\Exceptions\Http;
use Api\Exceptions\Json;
use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Message\Form\FormRequest;
use \Buzz\Message\RequestInterface;

/**
 * Базовый класс команды API.
 */
abstract class Command
{
    /**
     * Объект API.
     *
     * @var null|\Api\Api
     */
    protected $api = null;

    /**
     * URI, на который отправлять запросы.
     *
     * @var null|string
     */
    protected $uri = null;

    /**
     * Метод, которым отправлять запросы.
     *
     * @var null|string
     */
    protected $method = RequestInterface::METHOD_GET;

    /**
     * Массив параметров для строки запроса (GET).
     *
     * @var array
     */
    protected $queryParameters = [];

    /**
     * Массив параметров для тела запроса (POST).
     *
     * @var array
     */
    protected $postParameters = [];

    /**
     * Конструктор.
     *
     * @param \Api\Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Устанавливает параметры строки запроса (GET).
     *
     * @param array $params
     */
    public function setQuery(array $params)
    {
        $this->queryParameters = $params;
    }

    /**
     * Устанавливает параметр строки запроса (GET).
     *
     * @param string $key
     * @param string $value
     */
    public function addQuery($key, $value)
    {
        $this->queryParameters[$key] = $value;
    }

    /**
     * Возвращает параметры строки запроса (GET).
     *
     * @return array
     */
    public function getQuery()
    {
        return $this->queryParameters;
    }

    /**
     * Устанавливает параметры тела запроса (POST).
     *
     * @param array $params
     */
    public function setPost(array $params)
    {
        $this->postParameters = $params;
    }

    /**
     * Устанавливает параметр тела запроса (POST).
     *
     * @param string $key
     * @param string $value
     */
    public function addPost($key, $value)
    {
        $this->postParameters[$key] = $value;
    }

    /**
     * Возвращает параметры тела запроса (POST).
     *
     * @return array
     */
    public function getPost()
    {
        return $this->postParameters;
    }

    /**
     * Возвращает результаты запроса.
     *
     * @return mixed
     * @throws \Api\Exceptions\Exception
     */
    public function getResult()
    {
        $uri = sprintf(
            '%s://%s/%s?%s',
            $this->api->getScheme(),
            $this->api->getDomain(),
            $this->uri,
            http_build_query(array_merge(
                $this->queryParameters,
                ['appId' => $this->api->getAppId(), 'appKey' => $this->api->getAppKey()]
            ))
        );

        $browser = new Browser(new Curl());
        $request = new FormRequest($this->method, $uri);

        if ($this->method == RequestInterface::METHOD_POST && !empty($this->postParameters)) {
            foreach ($this->postParameters as $key => $value) {
                $request->setField($key, $value);
            }
        }

        /** @var \Buzz\Message\Response $result */
        $result = $browser->send($request);

        if ($result->isClientError() || $result->isServerError()) {
            switch ($result->getStatusCode()) {
                case 404:
                    throw new Http(sprintf(
                        'API returned 404 on request to «%s»: %s',
                        $this->uri,
                        $result->getContent()
                    ), 404);
                    break;

                default:
                    throw new Http(sprintf(
                        'API returned 500 on request to «%s»: %s',
                        $this->uri,
                        $result->getContent()
                    ), 500);
                    break;
            }
        }

        $json  = json_decode($result->getContent(), true);
        $error = json_last_error();

        if ($error !== JSON_ERROR_NONE) {
            throw new Json(sprintf(
                '%s on %s',
                $this->jsonError($error),
                $this->uri
            ));
        }

        return $json;
    }

    /**
     * Возвращает текстовое представление ошибки декодера JSON.
     *
     * @param  integer $errNo
     * @return string
     */
    protected function jsonError($errNo)
    {
        switch ($errNo) {
            case JSON_ERROR_DEPTH:
                $msg = 'The maximum stack depth has been exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $msg = 'Invalid or malformed JSON';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $msg = 'Control character error, possibly incorrectly encoded';
                break;
            case JSON_ERROR_SYNTAX:
                $msg = 'Syntax error';
                break;
            case JSON_ERROR_UTF8:
                $msg = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            default:
                $msg = 'Unknown error occured while parsing JSON from API';
                break;
        }

        return $msg;
    }
}