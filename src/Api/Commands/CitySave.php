<?php
namespace Api\Commands;

use Api\Api;

/**
 * Сохранение города.
 */
class CitySave extends PostCommand
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'city/save';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param array $data
     */
    public function __construct(Api $api, array $data = [])
    {
        parent::__construct($api);

        $this->setPost(['data' => $data]);
    }
}