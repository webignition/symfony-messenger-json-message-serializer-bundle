<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Envelope;

interface SerializableEnvelopeInterface
{
    public const KEY_BODY = 'body';
    public const KEY_HEADERS = 'headers';
    public const KEY_HEADER_STAMPS = 'stamps';

    /**
     * @return array<mixed>
     */
    public function encode(): array;
}
