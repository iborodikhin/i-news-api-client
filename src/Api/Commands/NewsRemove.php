<?php
namespace Api\Commands;

use Api\Api;

/**
 * Команда удаления новости.
 */
class NewsRemove extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'news/remove';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param array    $ids
     */
    public function __construct(Api $api, $id)
    {
        parent::__construct($api);

        $this->setQuery(['id' => $id]);
    }
}