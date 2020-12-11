<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional\Services;

use webignition\JsonMessageSerializerBundle\Services\Serializer;
use webignition\JsonMessageSerializerBundle\Tests\AbstractSerializerTest;
use webignition\JsonMessageSerializerBundle\Tests\Functional\FunctionalTestContainerSetupTrait;

class SerializerTest extends AbstractSerializerTest
{
    use FunctionalTestContainerSetupTrait;

    private Serializer $serializer;

    protected function createSerializer(): Serializer
    {
        $container = $this->createContainer();

        $serializer = $container->get(Serializer::class);
        self::assertInstanceOf(Serializer::class, $serializer);
        if ($serializer instanceof Serializer) {
            $this->serializer = $serializer;
        }

        return $this->serializer;
    }
}
