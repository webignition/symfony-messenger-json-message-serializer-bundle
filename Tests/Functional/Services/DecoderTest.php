<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Functional\AbstractFunctionalTest;

class DecoderTest extends AbstractFunctionalTest
{
    use DecoderDataProviderTrait;

    private Decoder $decoder;

    protected function setUp(): void
    {
        parent::setUp();

        $decoder = $this->container->get(Decoder::class);
        self::assertInstanceOf(Decoder::class, $decoder);
        if ($decoder instanceof Decoder) {
            $this->decoder = $decoder;
        }
    }

    /**
     * @dataProvider decoderDecodeDataProvider
     *
     * @param array<mixed> $encodedEnvelope
     */
    public function testDecode(array $encodedEnvelope, Envelope $expectedEnvelope)
    {
        self::assertEquals($expectedEnvelope, $this->decoder->decode($encodedEnvelope));
    }
}
