<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение нескольких персон по id.
 */
class PersonGetMany extends Command
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
     * @param array    $ids
     */
    public function __construct(Api $api, array $ids = [])
    {
        parent::__construct($api);

        $this->setQuery(['ids' => $ids]);
    }
}