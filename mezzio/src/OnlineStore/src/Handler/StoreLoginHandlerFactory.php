<?php

declare(strict_types=1);

namespace OnlineStore\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class StoreLoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : StoreLoginHandler
    {
        return new StoreLoginHandler(
            $container->get(EntityManager::class),
            $container->get(HalResponseFactory::class),
            $container->get(ResourceGenerator::class)
        );
    }
}
