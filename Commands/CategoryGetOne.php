<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение категории по id.
 */
class CategoryGetOne extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'category/get-one';

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