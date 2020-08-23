<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->get('/login[/]', Handler\ProjectsAuthHandler::class, 'projects');
        $app->post('/projects[/]', Handler\ProjectsCreateHandler::class, 'projects');
        $app->get('/projects/[page/{page:\d+}]', Handler\ProjectsReadHandler::class, 'projects');
        // $app->get('/projects[/]', Handler\ProjectsAuthHandler::class, 'projects.read');

        return $app;
        // TODO: Implement __invoke() method.
    }
}