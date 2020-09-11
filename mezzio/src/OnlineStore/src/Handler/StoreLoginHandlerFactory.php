<?php

declare(strict_types=1);

namespace OnlineStore\Handler;

use Psr\Container\ContainerInterface;

class StoreLoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : StoreLoginHandler
    {
        return new StoreLoginHandler();
    }
}
