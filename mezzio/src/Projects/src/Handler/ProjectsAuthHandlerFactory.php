<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class ProjectsAuthHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsAuthHandler
    {
        $container->get(EntityManager::class);
        $container->get(HalResponseFactory::class);
        $container->get(ResourceGenerator::class);

        return new ProjectsAuthHandler(
            $container->get(EntityManager::class),
            $container->get(HalResponseFactory::class),
            $container->get(ResourceGenerator::class)
        );
    }
}
