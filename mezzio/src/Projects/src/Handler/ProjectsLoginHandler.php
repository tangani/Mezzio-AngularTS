<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Login;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsLoginHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $halResponseFactory;
    protected $resourceGenerator;

    /**
     * AnnouncementsViewHandler constructor.
     * @param EntityManager $entityManager
     * @param HalResponseFactory $halResponseFactory
     * @param ResourceGenerator $resourceGenerator
     */
    public function __construct(
        EntityManager $entityManager,
        HalResponseFactory $halResponseFactory,
        ResourceGenerator $resourceGenerator
    )
    {
        $this->entityManager       = $entityManager;
        $this->halResponseFactory  = $halResponseFactory;
        $this->resourceGenerator   = $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $id = $request->getAttribute('id', null);
        $repository = $this->entityManager->getRepository(Login::class);
        $entity = $repository->find($id);

        if (empty($entity)) {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found';

            return  new JsonResponse($result, 400);
        }



        // return new JsonResponse($entity);

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return $this->halResponseFactory->createResponse($request, $resource);

        /*

        $result = [];
        $requestBody = $request->getParsedBody();

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request body';

            return  new JsonResponse($result, 400);
        }

        $entity = new Login();
        $result = $entity->getUser($requestBody);

        return new JsonResponse($result);

        /*
        $entityRepository = $this->entityManager->getRepository(Login::class);

        $entity = $entityRepository->find($request->getAttribute('username'));

        if (empty($entity)) {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found';

            return  new JsonResponse($result, 400);
        }


        $entity = new Login();

        try {
            $entity->getUser($requestBody);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch(ORMException $e) {
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getLine();

            return new JsonResponse($result);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return $this->halResponseFactory->createResponse($request, $resource);


        /*
        $query = $this->entityManager->getRepository('Projects\Entity\Login')
            ->createQueryBuilder('c')
            ->getQuery();

        $paginator = new Paginator($query);
        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($records);


        // Create and return a response
        $result['_embeded'] = [1 => "test", 2 => "test2"];
        return  new JsonResponse($result);
        */
    }
}
