<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\Functional\AbstractFunctionalTest;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

class MessageFactoryTest extends AbstractFunctionalTest
{
    private MessageFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $messageFactory = $this->container->get(MessageFactory::class);
        self::assertInstanceOf(MessageFactory::class, $messageFactory);
        if ($messageFactory instanceof MessageFactory) {
            $this->factory = $messageFactory;
        }
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
}
