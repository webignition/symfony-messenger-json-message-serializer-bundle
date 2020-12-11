<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Envelope;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Envelope\SerializableEnvelope;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\EnvelopeDataProviderTrait;

class SerializableEnvelopeTest extends TestCase
{
    use EnvelopeDataProviderTrait;

    /**
     * @dataProvider envelopeEncodeDataProvider
     *
     * @param array<mixed> $expectedSerializedEnvelope
     */
    public function testEncode(Envelope $envelope, array $expectedSerializedEnvelope)
    {
        $serializableEnvelope = (new SerializableEnvelope($envelope));

        self::assertSame($expectedSerializedEnvelope, $serializableEnvelope->encode());
    }
}
