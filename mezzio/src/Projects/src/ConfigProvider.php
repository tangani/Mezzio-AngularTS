<?php

declare(strict_types=1);

namespace Projects;

use Projects\Handler;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

/**
 * The configuration provider for the Projects module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'doctrine'     => $this->getDoctrineEntities(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'delegators' => [
                \Mezzio\Application::class => [
                    RoutesDelegator::class,
                    ],
            ],
            'invokables' => [
            ],
            'factories'  => [
                Handler\ProjectsAuthHandler::class => Handler\ProjectsAuthHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'projects'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getDoctrineEntities(): array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Projects\Entity' => 'project_entity',
                    ],
                ],
                'project_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }
}
