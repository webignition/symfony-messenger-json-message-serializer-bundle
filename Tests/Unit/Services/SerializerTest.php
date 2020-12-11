<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Unit\Services;

use webignition\JsonMessageSerializerBundle\Services\Serializer;
use webignition\JsonMessageSerializerBundle\Tests\AbstractSerializerTest;
use webignition\JsonMessageSerializerBundle\Tests\Services\DecoderFactory;

class SerializerTest extends AbstractSerializerTest
{
    protected function createSerializer(): Serializer
    {
        return new Serializer(DecoderFactory::create());
    }
}
