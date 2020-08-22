<?php

declare(strict_types=1);

namespace Projects\Handler;

use Psr\Container\ContainerInterface;

class ProjectsWriteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProjectsWriteHandler
    {
        return new ProjectsWriteHandler();
    }
}
