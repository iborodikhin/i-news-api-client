<?php
namespace Api\Commands;

/**
 * Получение всех категорий.
 */
class CategoryGetAll extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'category/get-all';
}