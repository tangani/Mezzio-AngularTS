<?php

declare(strict_types=1);

namespace OnlineStore\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class StoreSignUpHandlerFactory
{
    public function __invoke(ContainerInterface $container) : StoreSignUpHandler
    {
        return new StoreSignUpHandler(
            $container->get(EntityManager::class),
            $container->get(HalResponseFactory::class),
            $container->get(ResourceGenerator::class)
        );
    }
}
