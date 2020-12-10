<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Exception;

class UnknownMessageClassException extends \Exception
{
    /**
     * @var class-string
     */
    private string $class;

    /**
     * @param class-string $class
     */
    public function __construct(string $class)
    {
        parent::__construct();

        $this->class = $class;
    }

    /**
     * @return class-string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
