<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Impl\Message;

use webignition\JsonMessageSerializerBundle\Message\AbstractSerializableMessage;

class TestStringMessage extends AbstractSerializableMessage
{
    public const TYPE = 'test-string-message';
    public const PAYLOAD_KEY_VALUE = 'string';

    private string $value;

    public function __construct(string $value)
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
        return new TestStringMessage((string) ($data[self::PAYLOAD_KEY_VALUE] ?? ''));
    }
}
