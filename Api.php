<?php
namespace Api;

/**
 * Основной класс библиотеки для работы с API.
 */
class Api
{
    /**
     * Схема для отправки запросов.
     *
     * @var string
     */
    protected $scheme = 'http';

    /**
     * Базовый URL для отправки запросов.
     *
     * @var null|string
     */
    protected $domain = null;

    /**
     * Идентификатор приложения.
     *
     * @var null|string
     */
    protected $appId = null;

    /**
     * Ключ приложения.
     *
     * @var null|string
     */
    protected $appKey = null;

    /**
     * Конструктор.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (isset($options['domain'])) {
            $this->domain = $options['domain'];
        }

        if (isset($options['appId'])) {
            $this->domain = $options['appId'];
        }

        if (isset($options['appKey'])) {
            $this->domain = $options['appKey'];
        }
    }

    /**
     * Возвращает схему для выполнения запросов.
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Возвращает домен для выполнения запросов.
     *
     * @return null|string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Возвращает идентификатор приложения.
     *
     * @return null|string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Возвращает ключ приложения.
     *
     * @return null|string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Магический метод для вызова команд API.
     *
     * @param  string                                  $methodName
     * @param  array                                   $arguments
     * @return \Api\Commands\Command
     * @throws \Api\Exceptions\NoCommandFoundException
     */
    public function __call($methodName, $arguments = [])
    {
        $className = sprintf('\Api\Commands\%s', ucfirst($methodName));

        if (class_exists($className)) {
            array_unshift($arguments, $this);

            return (new \ReflectionClass($className))->newInstanceArgs($arguments);
        }

        throw new Exceptions\NoCommandFoundException(sprintf('Command %s not found', ucfirst($methodName)));
    }
}