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
        $entityManager = $container->get(EntityManager::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);

        return new ProjectsReadHandler(
            $entityManager,
            $container->get('config')['page_size'],
            $resourceGenerator,
            $halResponseFactory
        );
    }
}
