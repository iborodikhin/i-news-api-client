<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение нескольких городов по id.
 */
class CityGetMany extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'city/get-many';

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