<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение нескольких новостей по id.
 */
class NewsGetMany extends Command
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
     * @param array    $ids
     */
    public function __construct(Api $api, array $ids = [])
    {
        parent::__construct($api);

        $this->setQuery(['ids' => $ids]);
    }
}