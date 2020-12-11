<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use webignition\JsonMessageSerializerBundle\Services\Decoder;
use webignition\JsonMessageSerializerBundle\Tests\AbstractDecoderTest;
use webignition\JsonMessageSerializerBundle\Tests\Functional\FunctionalTestContainerSetupTrait;

class DecoderTest extends AbstractDecoderTest
{
    use FunctionalTestContainerSetupTrait;

    private Decoder $decoder;

    protected function createDecoder(): Decoder
    {
        $container = $this->createContainer();

        $decoder = $container->get(Decoder::class);
        self::assertInstanceOf(Decoder::class, $decoder);
        if ($decoder instanceof Decoder) {
            $this->decoder = $decoder;
        }

        return $this->decoder;
    }
}
