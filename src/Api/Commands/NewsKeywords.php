<?php
namespace Api\Commands;
use Api\Api;

/**
 * Ключевые слова новости.
 */
class NewsKeywords extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/keywords';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param integer  $id
     * @param integer  $limit
     */
    public function __construct(Api $api, $id, $limit)
    {
        parent::__construct($api);

        $this->setQuery([
            'id'    => $id,
            'limit' => $limit,
        ]);
    }
}