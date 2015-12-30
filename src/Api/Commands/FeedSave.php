<?php
namespace Api\Commands;

use Api\Api;

/**
 * Сохранение источника.
 */
class FeedSave extends PostCommand
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'feed/save';

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