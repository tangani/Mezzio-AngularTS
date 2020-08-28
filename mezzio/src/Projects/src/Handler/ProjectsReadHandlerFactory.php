<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class ProjectsReadHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsReadHandler
    {
        $container->get(EntityManager::class);
        $container->get(ResourceGenerator::class);
        $container->get(HalResponseFactory::class);

        return new ProjectsReadHandler(
            $container->get(EntityManager::class),
            $container->get(HalResponseFactory::class),
            $container->get(ResourceGenerator::class)
        );
    }
}
