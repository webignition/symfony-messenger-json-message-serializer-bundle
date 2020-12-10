<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Envelope;

use Symfony\Component\Messenger\Envelope;
use webignition\JsonMessageSerializerBundle\Exception\UnknownMessageClassException;
use webignition\JsonMessageSerializerBundle\Message\JsonSerializableMessageInterface;

class SerializableEnvelope implements SerializableEnvelopeInterface
{
    private Envelope $envelope;

    public function __construct(Envelope $envelope)
    {
        $this->envelope = $envelope;
    }

    /**
     * @return array<mixed>
     *
     * @throws UnknownMessageClassException
     */
    public function encode(): array
    {
        $message = $this->envelope->getMessage();
        if (!$message instanceof JsonSerializableMessageInterface) {
            throw new UnknownMessageClassException(get_class($message));
        }

        $headers = [];
        $allStamps = [];
        foreach ($this->envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }

        if ([] !== $allStamps) {
            $headers[self::KEY_HEADER_STAMPS] = serialize($allStamps);
        }

        $data = [
            self::KEY_BODY => (string) json_encode($message),
        ];

        if ([] !== $headers) {
            $data[self::KEY_HEADERS] = $headers;
        }

        return $data;
    }
}
