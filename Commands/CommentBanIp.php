<?php
namespace Api\Commands;

use Api\Api;

/**
 * Команда бана по IP.
 */
class CommentBanIp extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'comment/ban';

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