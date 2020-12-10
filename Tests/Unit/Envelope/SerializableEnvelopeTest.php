<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Envelope;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use webignition\JsonMessageSerializerBundle\Envelope\SerializableEnvelope;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

class SerializableEnvelopeTest extends TestCase
{
    /**
     * @dataProvider encodeDataProvider
     *
     * @param SerializableEnvelope $envelope
     * @param array<mixed> $expectedSerializedEnvelope
     */
    public function testEncode(SerializableEnvelope $envelope, array $expectedSerializedEnvelope)
    {
        self::assertSame($expectedSerializedEnvelope, $envelope->encode());
    }

    public function encodeDataProvider(): array
    {
        $stringMessage = new TestStringMessage('string value');
        $integerMessage = new TestIntegerMessage(7);
        $booleanMessage = new TestBooleanMessage(true);

        return [
            'test string message' => [
                'envelope' => (new SerializableEnvelope(
                    new Envelope($stringMessage)
                )),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                ],
            ],
            'test string message with stamps' => [
                'envelope' => (new SerializableEnvelope(
                    new Envelope($stringMessage, [new DelayStamp(100)])
                )),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($stringMessage),
                    'headers' => [
                        'stamps' => serialize([new DelayStamp(100)])
                    ],
                ],
            ],
            'test integer message' => [
                'envelope' => (new SerializableEnvelope(
                    new Envelope($integerMessage)
                )),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($integerMessage),
                ],
            ],
            'test boolean message' => [
                'envelope' => (new SerializableEnvelope(
                    new Envelope($booleanMessage)
                )),
                'expectedSerializedEnvelope' => [
                    'body' => (string) json_encode($booleanMessage),
                ],
            ],
        ];
    }
}
