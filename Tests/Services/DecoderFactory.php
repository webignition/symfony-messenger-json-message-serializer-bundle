<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Services;

use webignition\JsonMessageSerializerBundle\Services\Decoder;

class DecoderFactory
{
    public static function create(): Decoder
    {
        return new Decoder(MessageFactoryFactory::create());
    }
}
