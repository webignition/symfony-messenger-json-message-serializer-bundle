<?php

declare(strict_types=1);

namespace webignition\JsonMessageSerializerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class JsonMessageSerializerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
    }
}
