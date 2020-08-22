<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->get('/projects[/]', Handler\ProjectsAuthHandler::class, 'projects');
        // $app->get('/projects[/]', Handler\ProjectsAuthHandler::class, 'projects.read');

        return $app;
        // TODO: Implement __invoke() method.
    }
}