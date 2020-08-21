<?php

namespace Elements;

use Elements\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->get('/elements[/]', Handler\ElementsReadHandler::class, 'elements.read');

        return $app;
    }
}