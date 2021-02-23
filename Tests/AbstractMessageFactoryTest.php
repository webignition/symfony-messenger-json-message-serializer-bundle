<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests;

use PHPUnit\Framework\TestCase;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageTypeException;
use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\MessageFactoryDataProviderTrait;

abstract class AbstractMessageFactoryTest extends TestCase
{
    use MessageFactoryDataProviderTrait;

    abstract protected function createFactory(): MessageFactory;

    /**
     * @dataProvider messageFactoryCreateDataProvider
     *
     * @param array<mixed> $payload
     */
    public function testCreate(string $type, array $payload, JsonSerializableMessageInterface $expectedMessage): void
    {
        $factory = $this->createFactory();

        self::assertEquals($expectedMessage, $factory->create($type, $payload));
    }

    public function testCreateThrowsUnknownMessageTypeException(): void
    {
        $factory = $this->createFactory();

        $this->expectExceptionObject(new UnknownMessageTypeException('invalid-type'));

        $factory->create('invalid-type', []);
    }
}
