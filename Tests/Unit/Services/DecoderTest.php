<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Tests\AbstractDecoderTest;
use webignition\JsonMessageSerializerBundle\Tests\Services\DecoderFactory;

class DecoderTest extends AbstractDecoderTest
{
    protected function createDecoder(): Decoder
    {
        return DecoderFactory::create();
    }
}
