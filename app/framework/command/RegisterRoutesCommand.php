<?php


namespace Framework\command;


use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterRoutesCommand implements CommandInterface
{
    private $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function execute(): void
    {
        $routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $routeCollection);
    }
}