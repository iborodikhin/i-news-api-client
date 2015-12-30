<?php
namespace Api\Commands;

/**
 * Получение всех источников.
 */
class FeedGetAll extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'feed/get-all';
}