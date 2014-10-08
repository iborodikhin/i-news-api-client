<?php
namespace Api\Commands;

use Api\Api;

class NewsSave extends PostCommand
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/save';

    /**
     * @param \Api\Api $api
     * @param array    $data
     */
    public function __construct(Api $api, array $data = [])
    {
        parent::__construct($api);

        $this->setPost(['data' => $data]);
    }
}