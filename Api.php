<?php
namespace Api;

/**
 * Основной класс библиотеки для работы с API.
 *
 * @method \Api\Commands\CategoryGetAll       categoryGetAll()
 * @method \Api\Commands\CategoryGetOne       categoryGetOne($id)
 * @method \Api\Commands\CityGetAll           cityGetAll()
 * @method \Api\Commands\CityGetMany          cityGetMany(array $ids)
 * @method \Api\Commands\CityGetOne           cityGetOne($id)
 * @method \Api\Commands\CommentGetAll        commentGetAll($newsId)
 * @method \Api\Commands\CommentGetMany       commentGetMany(array $ids)
 * @method \Api\Commands\CommentSave          commentSave(array $data)
 * @method \Api\Commands\CommentSave          commentSearch(array $query, array $orderBy, $offset, $limit)
 * @method \Api\Commands\FeedGetAll           feedGetAll()
 * @method \Api\Commands\FeedGetCategories    feedGetCategories()
 * @method \Api\Commands\FeedGetOne           feedGetOne($id)
 * @method \Api\Commands\NewsGetMany          newsGetMany(array $ids)
 * @method \Api\Commands\NewsGetOne           newsGetOne($id)
 * @method \Api\Commands\NewsKeywords         newsGetKeywords($id, $limit)
 * @method \Api\Commands\NewsMoreLikeThis     newsMoreLikeThis($id, $limit)
 * @method \Api\Commands\NewsSave             newsSave(array $data)
 * @method \Api\Commands\NewsSearch           newsSearch(array $params)
 * @method \Api\Commands\NewsSearchAndGroupBy newsSearchAndGroupBy(array $query, $groupBy)
 * @method \Api\Commands\PersonGetAll         personGetAll()
 * @method \Api\Commands\PersonGetMany        personGetMany(array $ids)
 * @method \Api\Commands\PersonGetOne         personGetOne($id)
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
     * Лог запросов в API.
     *
     * @var array
     */
    protected $queryLog = [];

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
            $this->appId = $options['appId'];
        } else {
            throw new \InvalidArgumentException('Parameter «appId» is required.');
        }

        if (isset($options['appKey'])) {
            $this->appKey = $options['appKey'];
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

    /**
     * Добавляет запись в лог запросов к API.
     *
     * @param array $log
     */
    public function appendLog(array $log)
    {
        $this->queryLog[] = $log;
    }

    /**
     * Возвращает лог запросов к API.
     *
     * @return array
     */
    public function getLog()
    {
        return $this->queryLog;
    }
}