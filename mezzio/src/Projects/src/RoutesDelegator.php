<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        $app->post('/signin[/]', Handler\ProjectsAuthHandler::class, 'user.create');

        $app->post('/projects[/]', Handler\ProjectsCreateHandler::class, 'projects.create');
        // For a specific record
        // $app->get('/projects/{id:\d+}[/]', Handler\ProjectsViewHandler::class, 'projects.view' );
        // For pagination usage
        $app->get('/projects/[?page={page:\d+}]', Handler\ProjectsReadHandler::class, 'projects.read');

        // $app->put('/projects/{id:\d+}[/]', Handler\ProjectsUpdateHandler::class, 'projects.update');

        // $app->delete('/projects/{id:\d+}[/]', Handler\ProjectDeleteHandler::class, 'projects.delete');

        // $app->get('/projects[/]', Handler\ProjectsAuthHandler::class, 'projects.read');

        return $app;
        // TODO: Implement __invoke() method.
    }
}