<?php
namespace Api\Commands;

use \Buzz\Message\RequestInterface;

/**
 * Базовый класс команд, исполняющихся методом POST.
 */
abstract class PostCommand extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $method = RequestInterface::METHOD_POST;
}