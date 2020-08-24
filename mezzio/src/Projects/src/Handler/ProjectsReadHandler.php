<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Project;
use Projects\Entity\ProjectCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsReadHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;
    protected $resourceGenerator;
    protected $halResponseFactory;

    public function __construct(
        EntityManager $entityManager,
        $pageCount,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory
    )
    {
        $this->entityManager      = $entityManager;
        $this->pageCount          = $pageCount;
        $this->resourceGenerator  = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $repository = $this->entityManager->getRepository(Project::class);

        $query = $repository
            ->createQueryBuilder('p')
            ->orderBy('p.start', 'ASC')
            ->setMaxResults($this->pageCount)
            ->getQuery();

        $paginator = new ProjectCollection($query);

        $resource = $this->resourceGenerator->fromObject($paginator, $request);

        return $this->halResponseFactory->createResponse($request, $resource);
    }
}
