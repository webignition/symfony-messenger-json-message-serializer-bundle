<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\Tests\Functional;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;
use webignition\JsonMessageSerializerBundle\JsonMessageSerializerBundle;

class JsonMessageSerializerBundleTestingKernel extends Kernel
{
    /**
     * @return BundleInterface[]
     */
    public function registerBundles(): array
    {
        return [
            new JsonMessageSerializerBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }
}
