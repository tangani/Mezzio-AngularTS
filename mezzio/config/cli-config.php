<?php

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\EntityManager;

$container = require __DIR__ . '/container.php';

return new HelperSet([
    'em' => new EntityManagerHelper(
        // $container->get('doctrine.entity_manager.orm_default')
        $container->get(EntityManager::class)   // Set in App/ConfigProvider.php
    ),
]);