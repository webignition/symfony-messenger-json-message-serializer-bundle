<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\DataProvider;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

trait DecoderDataProviderTrait
{
    public function decodeDataProvider(): array
    {
        $booleanMessage = new TestBooleanMessage(true);
        $integerMessage = new TestIntegerMessage(7);
        $stringMessage = new TestStringMessage('string value');

        return [
            'test boolean message' => [
                'encodedEnvelope' => [
                    'body' => (string) json_encode($booleanMessage),
                ],
                'expectedMessage' => new Envelope($booleanMessage),
            ],
            'test integer message' => [
                'encodedEnvelope' => [
                    'body' => (string) json_encode($integerMessage),
                ],
                'expectedMessage' => new Envelope($integerMessage),
            ],
            'test string message' => [
                'encodedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                ],
                'expectedMessage' => new Envelope($stringMessage),
            ],
            'test string message with stamps' => [
                'encodedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                    'headers' => [
                        'stamps' => serialize([new DelayStamp(100)])
                    ],
                ],
                'expectedMessage' => new Envelope($stringMessage, [new DelayStamp(100)]),
            ],
        ];
    }
}
