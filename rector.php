<?php

declare(strict_types=1);

use ASTDemo\Rector\ClassMethodFooToBar;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {

    $parameters = $containerConfigurator->parameters();

    $services = $containerConfigurator->services();
    $services->set(ClassMethodFooToBar::class);
};
