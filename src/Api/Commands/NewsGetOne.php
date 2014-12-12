<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение новости по id.
 */
class NewsGetOne extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/get-one';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param integer  $id
     */
    public function __construct(Api $api, $id)
    {
        parent::__construct($api);

        $this->setQuery(['id' => $id]);
    }
}