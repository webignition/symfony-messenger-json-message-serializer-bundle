<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Services\MessageFactory;
use webignition\JsonMessageSerializerBundle\Tests\DataProvider\DecoderDataProviderTrait;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestBooleanMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestIntegerMessage;
use webignition\JsonMessageSerializerBundle\Tests\Impl\Message\TestStringMessage;

class DecoderTest extends TestCase
{
    use DecoderDataProviderTrait;

    private Decoder $decoder;

    protected function setUp(): void
    {
        parent::setUp();

        $factory = new MessageFactory([
            TestBooleanMessage::TYPE => TestBooleanMessage::class,
            TestIntegerMessage::TYPE => TestIntegerMessage::class,
            TestStringMessage::TYPE => TestStringMessage::class,
        ]);

        $this->decoder = new Decoder($factory);
    }

    /**
     * @dataProvider decodeDataProvider
     *
     * @param array<mixed> $encodedEnvelope
     */
    public function testDecode(array $encodedEnvelope, Envelope $expectedEnvelope)
    {
        self::assertEquals($expectedEnvelope, $this->decoder->decode($encodedEnvelope));
    }
}
