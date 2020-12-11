<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Exception;

class UnknownMessageTypeException extends \Exception
{
    private string $type;

    public function __construct(string $type)
    {
        parent::__construct();

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
