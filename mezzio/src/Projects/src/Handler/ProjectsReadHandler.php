<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsReadHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;

    public function __construct(EntityManager $entityManager, $pageCount)
    {
        $this->entityManager = $entityManager;
        $this->pageCount = $pageCount;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $query = $this->entityManager->getRepository('Projects\Entity\Project')
            ->createQueryBuilder('c')
            ->getQuery();

        $paginator = new Paginator($query);

        $totalItems = count($paginator);
        $currentPage = ($request->getAttribute('page')) ?: 1;
        $totalPageCount = ceil($totalItems / $this->pageCount);
        $nextPage = (($currentPage < $totalPageCount) ? $currentPage + 1 : $totalPageCount);
        $previousPage = (($currentPage > 1) ? $currentPage - 1 : 1);

        $records = $paginator
            ->getQuery()
            ->setFirstResult($this->pageCount * ($currentPage - 1))
            ->setMaxResults($this->pageCount)
            ->getResult(Query::HYDRATE_ARRAY);

        $result['_embedded']['Projects'] = $records;

        return new JsonResponse($result);
    }
}
