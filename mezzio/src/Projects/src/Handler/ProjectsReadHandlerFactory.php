<?php

declare(strict_types=1);

namespace Projects\Handler;

use Psr\Container\ContainerInterface;

class ProjectsReadHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsReadHandler
    {
        return new ProjectsReadHandler();
    }
}
