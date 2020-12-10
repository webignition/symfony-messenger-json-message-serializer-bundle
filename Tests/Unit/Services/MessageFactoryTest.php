<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageTypeException;
use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

class MessageFactoryTest extends TestCase
{
    private MessageFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new MessageFactory([
            TestBooleanMessage::TYPE => TestBooleanMessage::class,
            TestIntegerMessage::TYPE => TestIntegerMessage::class,
            TestStringMessage::TYPE => TestStringMessage::class,
        ]);
    }

    /**
     * @dataProvider createDataProvider
     *
     * @param array<mixed> $payload
     */
    public function testCreate(string $type, array $payload, JsonSerializableMessageInterface $expectedMessage)
    {
        self::assertEquals($expectedMessage, $this->factory->create($type, $payload));
    }

    public function createDataProvider(): array
    {
        return [
            'test boolean message' => [
                'type' => TestBooleanMessage::TYPE,
                'payload' => [
                    'boolean' => true,
                ],
                'expectedMessage' => new TestBooleanMessage(true),
            ],
            'test integer message' => [
                'type' => TestIntegerMessage::TYPE,
                'payload' => [
                    'integer' => 7,
                ],
                'expectedMessage' => new TestIntegerMessage(7),
            ],
            'test string message' => [
                'type' => TestStringMessage::TYPE,
                'payload' => [
                    'string' => 'value',
                ],
                'expectedMessage' => new TestStringMessage('value'),
            ],
        ];
    }

    public function testCreateThrowsUnknownMessageTypeException()
    {
        $this->expectExceptionObject(new UnknownMessageTypeException('invalid-type'));

        $this->factory->create('invalid-type', []);
    }
}
