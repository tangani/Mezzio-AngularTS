<?php

namespace Projects;

use Projects\Handler;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        /*
         * LOGIN
         */

        // $app->post('/login/{id:[0-9A-Za-z]+}', Handler\ProjectsAuthHandler::class, 'login.read');
        $app->get('/login/{username:[0-9A-Za-z]+}/{password:[0-9A-Za-z]+}[/]', Handler\ProjectsAuthHandler::class, 'login.read'); // WORKING
        // $app->post('/login/[?id={password:0-9A-Za-z}]', Handler\ProjectsAuthHandler::class, 'login.read');

        $app->post('/signup/', Handler\ProjectsSignupHandler::class, 'login.create');

        /*
         * PROJECTS
         */

        /*
        $app->post('/projects[/]', Handler\ProjectsCreateHandler::class, 'projects.create');
        */

        $app->post('/projectsUpdate/{id:\d+}', Handler\ProjectsUpdateHandler::class, 'project.update');

        // $app->get('/project/{id:[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}}', Handler\ProjectsReadHandler::class, 'project.read');
        // USE THE ONE BELOW
        $app->get('/project/{id:\d+}', Handler\ProjectsReadHandler::class, 'project.read');

        $app->get('/projects/[?page={page:\d+}]', Handler\ProjectsListHandler::class, 'projects.list');

        return $app;
        // TODO: Implement __invoke() method.
    }
}