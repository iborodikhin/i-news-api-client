<?php
namespace Api\Commands;

/**
 * Получение всех персон.
 */
class PersonGetAll extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'person/get-all';
}