<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Impl\Message;

use webignition\JsonMessageSerializerBundle\Message\AbstractSerializableMessage;

class TestBooleanMessage extends AbstractSerializableMessage
{
    public const TYPE = 'test-boolean-message';
    public const PAYLOAD_KEY_VALUE = 'boolean';

    private bool $value;

    public function __construct(bool $value)
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
        return new TestBooleanMessage((bool) ($data[self::PAYLOAD_KEY_VALUE] ?? false));
    }
}
