<?php
namespace Api\Commands;

use Api\Api;

/**
 * Сохранение города.
 */
class PersonSave extends PostCommand
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'person/save';

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