<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageTypeException;
use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\MessageFactoryDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Services\MessageFactoryFactory;

class MessageFactoryTest extends TestCase
{
    use MessageFactoryDataProviderTrait;

    private MessageFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = MessageFactoryFactory::create();
    }

    /**
     * @dataProvider messageFactoryCreateDataProvider
     *
     * @param array<mixed> $payload
     */
    public function testCreate(string $type, array $payload, JsonSerializableMessageInterface $expectedMessage)
    {
        self::assertEquals($expectedMessage, $this->factory->create($type, $payload));
    }

    public function testCreateThrowsUnknownMessageTypeException()
    {
        $this->expectExceptionObject(new UnknownMessageTypeException('invalid-type'));

        $this->factory->create('invalid-type', []);
    }
}
