<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение персоны по id.
 */
class PersonGetOne extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'person/get-one';

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