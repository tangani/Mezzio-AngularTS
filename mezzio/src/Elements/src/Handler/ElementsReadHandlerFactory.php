<?php

declare(strict_types=1);

namespace Elements\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ElementsReadHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ElementsReadHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new ElementsReadHandler($entityManager);
    }
}
