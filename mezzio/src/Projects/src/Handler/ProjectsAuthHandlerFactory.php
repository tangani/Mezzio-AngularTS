<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ProjectsAuthHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsAuthHandler
    {

        $entityManager = $container->get(EntityManager::class);

        return new ProjectsAuthHandler($entityManager);

        // return new ProjectsAuthHandler();
    }
}
