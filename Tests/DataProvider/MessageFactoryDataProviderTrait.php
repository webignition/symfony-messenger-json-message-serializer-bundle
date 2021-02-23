<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\DataProvider;

use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

trait MessageFactoryDataProviderTrait
{
    /**
     * @return array[]
     */
    public function messageFactoryCreateDataProvider(): array
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
