<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Serializer;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\EnvelopeDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Functional\AbstractFunctionalTest;

class SerializerTest extends AbstractFunctionalTest
{
    use EnvelopeDataProviderTrait;
    use DecoderDataProviderTrait;

    private Serializer $serializer;

    protected function setUp(): void
    {
        parent::setUp();

        $serializer = $this->container->get(Serializer::class);
        self::assertInstanceOf(Serializer::class, $serializer);
        if ($serializer instanceof Serializer) {
            $this->serializer = $serializer;
        }
    }

    /**
     * @dataProvider envelopeEncodeDataProvider
     *
     * @param array<mixed> $expectedSerializedEnvelope
     */
    public function testEncode(Envelope $envelope, array $expectedSerializedEnvelope)
    {
        self::assertSame($expectedSerializedEnvelope, $this->serializer->encode($envelope));
    }

    /**
     * @dataProvider decoderDecodeDataProvider
     *
     * @param array<mixed> $encodedEnvelope
     */
    public function testDecode(array $encodedEnvelope, Envelope $expectedEnvelope)
    {
        self::assertEquals($expectedEnvelope, $this->serializer->decode($encodedEnvelope));
    }

    /**
     * @dataProvider envelopeEncodeDataProvider
     */
    public function testEncodeDecode(Envelope $envelope)
    {
        self::assertEquals(
            $envelope,
            $this->serializer->decode(
                $this->serializer->encode($envelope)
            )
        );
    }
}
