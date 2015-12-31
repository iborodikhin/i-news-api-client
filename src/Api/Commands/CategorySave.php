<?php
namespace Api\Commands;

use Api\Api;

/**
 * Сохранение категории.
 */
class CategorySave extends PostCommand
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'category/save';

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