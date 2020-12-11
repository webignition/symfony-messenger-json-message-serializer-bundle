<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\MessageFactoryDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Functional\AbstractFunctionalTest;

class MessageFactoryTest extends AbstractFunctionalTest
{
    use MessageFactoryDataProviderTrait;

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
     * @dataProvider messageFactoryCreateDataProvider
     *
     * @param array<mixed> $payload
     */
    public function testCreate(string $type, array $payload, JsonSerializableMessageInterface $expectedMessage)
    {
        self::assertEquals($expectedMessage, $this->factory->create($type, $payload));
    }
}
