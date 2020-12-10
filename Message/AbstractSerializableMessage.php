<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Message;

abstract class AbstractSerializableMessage implements JsonSerializableMessageInterface
{
    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            self::KEY_TYPE => $this->getType(),
            self::KEY_PAYLOAD => $this->getPayload(),
        ];
    }
}
