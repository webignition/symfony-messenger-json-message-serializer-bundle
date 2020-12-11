<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Services;

use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

class MessageFactoryFactory
{
    public static function create(): MessageFactory
    {
        return new MessageFactory([
            TestBooleanMessage::TYPE => TestBooleanMessage::class,
            TestIntegerMessage::TYPE => TestIntegerMessage::class,
            TestStringMessage::TYPE => TestStringMessage::class,
        ]);
    }
}
