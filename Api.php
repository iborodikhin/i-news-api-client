<?php
namespace Api;

/**
 * Основной класс библиотеки для работы с API.
 *
 * @method \Api\Commands\CategoryGetAll    categoryGetAll()
 * @method \Api\Commands\CategoryGetOne    categoryGetOne()
 * @method \Api\Commands\CityGetAll        cityGetAll()
 * @method \Api\Commands\CityGetMany       cityGetMany()
 * @method \Api\Commands\CityGetOne        cityGetOne()
 * @method \Api\Commands\CommentGetAll     commentGetAll()
 * @method \Api\Commands\CommentGetMany    commentGetMany()
 * @method \Api\Commands\CommentSave       commentSave()
 * @method \Api\Commands\FeedGetAll        feedGetAll()
 * @method \Api\Commands\FeedGetCategories feedGetCategories()
 * @method \Api\Commands\FeedGetOne        feedGetOne()
 * @method \Api\Commands\NewsGetMany       newsGetMany()
 * @method \Api\Commands\NewsGetOne        newsGetOne()
 * @method \Api\Commands\NewsSave          newsSave()
 * @method \Api\Commands\NewsSearch        newsSearch()
 * @method \Api\Commands\PersonGetAll      personGetAll()
 * @method \Api\Commands\PersonGetMany     personGetMany()
 * @method \Api\Commands\PersonGetOne      personGetOne()
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
     * @param  array                     $options
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options = [])
    {
        if (isset($options['domain'])) {
            $this->domain = $options['domain'];
        } else {
            throw new \InvalidArgumentException('Parameter «domain» is required.');
        }

        if (isset($options['appId'])) {
            $this->domain = $options['appId'];
        } else {
            throw new \InvalidArgumentException('Parameter «appId» is required.');
        }

        if (isset($options['appKey'])) {
            $this->domain = $options['appKey'];
        } else {
            throw new \InvalidArgumentException('Parameter «appKey» is required.');
        }

        if (isset($options['scheme'])) {
            if (in_array($options['scheme'], array('http', 'https'))) {
                $this->scheme = $options['scheme'];
            } else {
                throw new \InvalidArgumentException('Parameter «scheme» should be one of [http, https] if passed.');
            }
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