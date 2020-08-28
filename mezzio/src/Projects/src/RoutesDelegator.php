<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->post('/login/{id:[0-9A-Za-z]+}', Handler\ProjectsAuthHandler::class, 'login.read');

        $app->post('/projects[/]', Handler\ProjectsCreateHandler::class, 'projects.create');

        $app->get('/project/{id:[0-9]}', Handler\ProjectsReadHandler::class, 'project.read');

        $app->get('/projects/[?page={page:\d+}]', Handler\ProjectsListHandler::class, 'projects.list');

        return $app;
        // TODO: Implement __invoke() method.
    }
}