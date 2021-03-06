<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение комментария по id.
 */
class CommentGetOne extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/get-one';

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