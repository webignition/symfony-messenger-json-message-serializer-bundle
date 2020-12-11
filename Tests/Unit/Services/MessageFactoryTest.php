<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\AbstractMessageFactoryTest;
use webignition\JsonMessageSerializerBundle\Tests\Services\MessageFactoryFactory;

class MessageFactoryTest extends AbstractMessageFactoryTest
{
    protected function createFactory(): MessageFactory
    {
        return MessageFactoryFactory::create();
    }
}
