<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\AbstractMessageFactoryTest;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\MessageFactoryDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Functional\FunctionalTestContainerSetupTrait;

class MessageFactoryTest extends AbstractMessageFactoryTest
{
    use MessageFactoryDataProviderTrait;
    use FunctionalTestContainerSetupTrait;

    private MessageFactory $factory;

    protected function createFactory(): MessageFactory
    {
        $container = $this->createContainer();

        $factory = $container->get(MessageFactory::class);
        self::assertInstanceOf(MessageFactory::class, $factory);
        if ($factory instanceof MessageFactory) {
            $this->factory = $factory;
        }

        return $this->factory;
    }
}
