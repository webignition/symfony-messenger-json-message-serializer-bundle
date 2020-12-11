<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Services\DecoderFactory;

class DecoderTest extends TestCase
{
    use DecoderDataProviderTrait;

    private Decoder $decoder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->decoder = DecoderFactory::create();
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
