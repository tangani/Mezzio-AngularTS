<?php

namespace OnlineStore;

use OnlineStore\Handler;
use Psr\Container\ContainerInterface;
use Projects;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        /**
         * Login
         */
        $app->get('/signIn/{username:[0-9A-Za-z]+}/{password:[0-9A-Za-z]+}[/]', Handler\StoreLoginHandler::class, 'login.read');

        $app->post('/joinUs/',  Handler\StoreSignUpHandler::class, 'login.create');

        return $app;
        // TODO: Implement __invoke() method.
    }
}