<?php
namespace Api\Commands;

use Api\Api;

/**
 * Поиск комментариев.
 */
class CommentSearch extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/search';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param $newsId
     */
    public function __construct(
        Api $api,
        array $query = [],
        array $orderBy = ['tstamp' => 'desc'],
        $offset = 0,
        $limit = 20)
    {
        parent::__construct($api);

        $this->setQuery([
            'query'    => $query,
            'order_by' => $orderBy,
            'offset'   => $offset,
            'limit'    => $limit,
        ]);
    }
}