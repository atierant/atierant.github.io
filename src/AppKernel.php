<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass;
use Symplify\SymfonyStaticDumper\ValueObject\SymfonyStaticDumperConfig;
use Symplify\SymplifyKernel\ValueObject\SymplifyKernelConfig;

class AppKernel extends Kernel
{
    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{config}.yaml');
        $container->import('../config/{services}.yaml');
        //$container->import(SymfonyStaticDumperConfig::FILE_PATH);
        $container->import(SymplifyKernelConfig::FILE_PATH);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import(__DIR__ . '/../../config/routes.php');
    }

    protected function build(ContainerBuilder $container): void
    {
        //$container->addCompilerPass(new AutowireArrayParameterCompilerPass());
    }
}
