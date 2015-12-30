<?php
namespace Api\Commands;

use Api\Api;

/**
 * Получение всех комментариев к новости.
 */
class CommentGetAll extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/get-all';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param $newsId
     */
    public function __construct(Api $api, $newsId)
    {
        parent::__construct($api);

        $this->setQuery(['newsId' => $newsId]);
    }
}