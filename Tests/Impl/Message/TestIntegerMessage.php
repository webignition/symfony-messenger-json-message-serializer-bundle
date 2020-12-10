<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Impl\Message;

use webignition\JsonMessageSerializerBundle\Message\AbstractSerializableMessage;

class TestIntegerMessage extends AbstractSerializableMessage
{
    public const TYPE = 'test-integer-message';
    public const PAYLOAD_KEY_VALUE = 'integer';

    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getPayload(): array
    {
        return [
            self::PAYLOAD_KEY_VALUE => $this->value,
        ];
    }

    /**
     * @param array<mixed> $data
     *
     * @return self
     */
    public static function createFromArray(array $data): self
    {
        return new TestIntegerMessage((int) ($data[self::PAYLOAD_KEY_VALUE] ?? 0));
    }
}
