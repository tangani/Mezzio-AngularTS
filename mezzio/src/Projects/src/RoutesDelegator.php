<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->post('/register[/]', Handler\ProjectsAuthHandler::class, 'projects.post');

        $app->post('/projects[/]', Handler\ProjectsCreateHandler::class, 'projects.post');
        // For a specific record
        $app->get();
        // For pagination usage
        $app->get('/projects/[page/{page:\d+}]', Handler\ProjectsReadHandler::class, 'projects.read');
        $app->put();
        $app->delete();
        // $app->get('/projects[/]', Handler\ProjectsAuthHandler::class, 'projects.read');

        return $app;
        // TODO: Implement __invoke() method.
    }
}