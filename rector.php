<?php

declare(strict_types=1);

use ASTDemo\Rector\ClassMethodFooToBar;
use ASTDemo\Rector\FunctionCallBarToBaz;
use ASTDemo\Rector\HogeRenameRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {

    $parameters = $containerConfigurator->parameters();

    $services = $containerConfigurator->services();
    $services->set(ClassMethodFooToBar::class);
    $services->set(FunctionCallBarToBaz::class);
    $services->set(HogeRenameRector::class);
};
