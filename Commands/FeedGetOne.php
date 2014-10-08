<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение источника по id.
 */
class FeedGetOne extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'feed/get-one';

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