<?php
namespace Api\Commands;

use Api\Api;

/**
 * Отписка от уведомлений о новых комментариях.
 */
class CommentUnsubscribe extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/unsubscribe';

    /**
     * {@inheritdoc}
     *
     * @param \Api\Api $api
     * @param string   $key
     */
    public function __construct(Api $api, $key = '')
    {
        parent::__construct($api);

        $this->setQuery(['key' => $key]);
    }
}