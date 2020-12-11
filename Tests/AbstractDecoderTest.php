<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;

abstract class AbstractDecoderTest extends TestCase
{
    use DecoderDataProviderTrait;

    abstract protected function createDecoder(): Decoder;

    /**
     * @dataProvider decoderDecodeDataProvider
     *
     * @param array<mixed> $encodedEnvelope
     */
    public function testDecode(array $encodedEnvelope, Envelope $expectedEnvelope)
    {
        $decoder = $this->createDecoder();

        self::assertEquals($expectedEnvelope, $decoder->decode($encodedEnvelope));
    }
}
