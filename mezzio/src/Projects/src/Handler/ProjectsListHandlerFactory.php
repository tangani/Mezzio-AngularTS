<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class ProjectsListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsListHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $recourseGenerator = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);

        return new ProjectsListHandler(
            $entityManager,
            $container->get('config')['page_size'],
            $recourseGenerator,
            $halResponseFactory
        );
    }
}
