<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Services;

use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Envelope\SerializableEnvelopeInterface;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageTypeException;
use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;

class Decoder
{
    private MessageFactory $messageFactory;

    public function __construct(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
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
        $body = $encodedEnvelope[SerializableEnvelopeInterface::KEY_BODY] ?? '';
        $bodyData = json_decode($body, true);
        $bodyData = is_array($bodyData) ? $bodyData : [];

        $type = $bodyData[JsonSerializableMessageInterface::KEY_TYPE] ?? '';
        if (!is_string($type)) {
            $type = '';
        }

        $payload = $bodyData[JsonSerializableMessageInterface::KEY_PAYLOAD] ?? [];
        if (!is_array($payload)) {
            $payload = [];
        }

        $message = $this->messageFactory->create($type, $payload);

        $headers = $encodedEnvelope[SerializableEnvelopeInterface::KEY_HEADERS] ?? [];
        $headers = is_array($headers) ? $headers : [];

        $stamps = [];
        if (isset($headers[SerializableEnvelopeInterface::KEY_HEADER_STAMPS])) {
            $stamps = unserialize($headers[SerializableEnvelopeInterface::KEY_HEADER_STAMPS]);
        }

        return new Envelope($message, $stamps);
    }
}
