<?php

declare(strict_types=1);

namespace OnlineStore;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Mezzio\Hal\Metadata\MetadataMap;
use Mezzio\Hal\Metadata\RouteBasedCollectionMetadata;
use Mezzio\Hal\Metadata\RouteBasedResourceMetadata;
use OnlineStore\Entity\OnlineStoreCollection;

/**
 * The configuration provider for the OnlineStore module
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
            'dependencies'      => $this->getDependencies(),
            'templates'         => $this->getTemplates(),
            'doctrine'          => $this->getDoctrineEntities(),
            MetadataMap::class  => $this->getHalMetadataMap(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
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
                'online-store'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    private function getDoctrineEntities(): array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class'   => MappingDriverChain::class,
                    'drivers' => [
                        'OnlineStore\Entity' => 'onlineStore_entity',
                    ],
                ],
                'onlineStore_entiry' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . 'Entity'],
                ],
            ],
        ];
    }

    private function getHalMetadataMap()
    {
        return [
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => OnlineStoreCollection::class,
                'collection_relation' => 'onlineStore',
                'route' => 'onlineStore.list',
            ],
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => OnlineStore
            ]
        ];
    }
}
