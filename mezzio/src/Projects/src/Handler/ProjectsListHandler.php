<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Mezzio\Helper\UrlHelper;
use Projects\Entity\Project;
use Projects\Entity\ProjectCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


/**
 * Class ProjectsListHandler
 * @package Projects\Handler
 */
class ProjectsListHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;
    protected $recourseGenerator;
    protected $halResponseFactory;

    /**
     * ProjectsListHandler constructor.
     * @param EntityManager $entityManager
     * @param $pageCount
     * @param $resourceGenerator
     * @param $halResponseFactory
     */
    public function __construct(
        EntityManager $entityManager,
        $pageCount,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory
    )
    {
        $this->entityManager      = $entityManager;
        $this->pageCount          = $pageCount;
        $this->recourseGenerator  = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $repository = $this->entityManager->getRepository(Project::class);

        $query = $repository
            ->createQueryBuilder('p')
            //->orderBy('p.start', 'ASC')
            // ->setMaxResults($this->pageCount)
            ->getQuery();


        $paginator = new Paginator($query);
        // $paginator = new ProjectCollection($query);

        /*
        $resource = $this->recourseGenerator->fromObject($paginator, $request);
        return $this->halResponseFactory->createResponse($request, $resource);
        */

        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);


        return new JsonResponse($records);

    }
}
