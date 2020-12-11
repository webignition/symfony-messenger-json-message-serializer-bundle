<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\DataProvider;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

trait EnvelopeDataProviderTrait
{
    public function envelopeEncodeDataProvider(): array
    {
        $stringMessage = new TestStringMessage('string value');
        $integerMessage = new TestIntegerMessage(7);
        $booleanMessage = new TestBooleanMessage(true);

        return [
            'test string message' => [
                'envelope' => new Envelope($stringMessage),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                ],
            ],
            'test string message with stamps' => [
                'envelope' => new Envelope($stringMessage, [new DelayStamp(100)]),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                    'headers' => [
                        'stamps' => serialize([new DelayStamp(100)])
                    ],
                ],
            ],
            'test integer message' => [
                'envelope' => new Envelope($integerMessage),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($integerMessage),
                ],
            ],
            'test boolean message' => [
                'envelope' => new Envelope($booleanMessage),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($booleanMessage),
                ],
            ],
        ];
    }
}
