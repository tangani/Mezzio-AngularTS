<?php

declare(strict_types=1);

namespace Elements\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ElementsReadHandler implements RequestHandlerInterface
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $query = $this->entityManager->getRepository('Elements\Entity\Element')
            ->createQueryBuilder('c')
            ->getQuery();

        $paginator = new Paginator($query);
        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($records);
    }
}
