<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Serializer;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\EnvelopeDataProviderTrait;

abstract class AbstractSerializerTest extends TestCase
{
    use EnvelopeDataProviderTrait;
    use DecoderDataProviderTrait;

    abstract protected function createSerializer(): Serializer;

    /**
     * @dataProvider envelopeEncodeDataProvider
     *
     * @param array<mixed> $expectedSerializedEnvelope
     */
    public function testEncode(Envelope $envelope, array $expectedSerializedEnvelope)
    {
        $serializer = $this->createSerializer();

        self::assertSame($expectedSerializedEnvelope, $serializer->encode($envelope));
    }

    /**
     * @dataProvider decoderDecodeDataProvider
     *
     * @param array<mixed> $encodedEnvelope
     */
    public function testDecode(array $encodedEnvelope, Envelope $expectedEnvelope)
    {
        $serializer = $this->createSerializer();

        self::assertEquals($expectedEnvelope, $serializer->decode($encodedEnvelope));
    }

    /**
     * @dataProvider envelopeEncodeDataProvider
     */
    public function testEncodeDecode(Envelope $envelope)
    {
        $serializer = $this->createSerializer();

        self::assertEquals(
            $envelope,
            $serializer->decode(
                $serializer->encode($envelope)
            )
        );
    }
}
