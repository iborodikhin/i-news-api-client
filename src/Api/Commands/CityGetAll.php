<?php
namespace Api\Commands;

/**
 * Получение всех городов.
 */
class CityGetAll extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $uri = 'city/get-all';
}