<?php
namespace Api\Commands;
use Api\Api;

/**
 * Поиск новостей.
 */
class NewsSearch extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/search';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param array    $params
     */
    public function __construct(Api $api, array $params = [])
    {
        parent::__construct($api);

        $this->setQuery($params);
    }
}