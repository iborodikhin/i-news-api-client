<?php
namespace Api\Commands;
use Api\Api;

/**
 * Поиск новостей с группировкой.
 */
class NewsSearchAndGroupBy extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/search-and-group-by';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param array    $query
     */
    public function __construct(Api $api, array $query = [], $groupByField)
    {
        parent::__construct($api);

        $this->setQuery(['query' => $query, 'group_by' => $groupByField]);
    }
}