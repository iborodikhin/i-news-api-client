<?php
namespace Api\Commands;

/**
 * Получение категорий источников.
 */
class FeedGetCategories extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'feed/get-categories';
}