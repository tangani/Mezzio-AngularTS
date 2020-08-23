<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ProjectsReadHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsReadHandler
    {
        $entityManager = $container->get(EntityManager::class);
        return new ProjectsReadHandler($entityManager, $container->get('config')['page_size']);
    }
}
