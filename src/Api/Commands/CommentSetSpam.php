<?php
namespace Api\Commands;

use Api\Api;

/**
 * Команда отмечания комментария спамом.
 */
class CommentSetSpam extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/set-spam';

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