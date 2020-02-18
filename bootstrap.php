<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yaml');

$containerBuilder->compile();

$operatorCollection = $containerBuilder->get(\App\Contract\OperatorCollectionInterface::class);

$taggedOperators = $containerBuilder->findTaggedServiceIds('app.operator');

foreach ($taggedOperators as $serviceName => $arr){
    $operator = $containerBuilder->get($serviceName);
    $operatorCollection->addOperator($operator);
}

$application = new Application();

$application->add(
    $containerBuilder->get(\App\Command\CalcCommand::class)
);

return [$application, $containerBuilder];