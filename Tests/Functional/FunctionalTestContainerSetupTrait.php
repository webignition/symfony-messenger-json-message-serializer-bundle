<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional;

use Psr\Container\ContainerInterface;

trait FunctionalTestContainerSetupTrait
{
    protected function createContainer(): ContainerInterface
    {
        $kernel = new JsonMessageSerializerBundleTestingKernel('test', true);
        $kernel->boot();

        return $kernel->getContainer();
    }
}
