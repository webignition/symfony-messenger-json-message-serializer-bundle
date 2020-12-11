<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Services;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\NonSendableStampInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use webignition\JsonMessageSerializerBundle\Envelope\SerializableEnvelope;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageClassException;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageTypeException;

class Serializer implements SerializerInterface
{
    private Decoder $decoder;

    public function __construct(Decoder $decoder)
    {
        $this->decoder = $decoder;
    }

    /**
     * @param array<mixed> $encodedEnvelope
     *
     * @return Envelope
     *
     * @throws UnknownMessageTypeException
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        return $this->decoder->decode($encodedEnvelope);
    }

    /**
     * @param Envelope $envelope
     *
     * @return array<mixed>
     *
     * @throws UnknownMessageClassException
     */
    public function encode(Envelope $envelope): array
    {
        $envelope = $envelope->withoutStampsOfType(NonSendableStampInterface::class);

        return (new SerializableEnvelope($envelope))->encode();
    }
}
