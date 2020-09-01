<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Login;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsAuthHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $halResponseFactory;
    protected $resourceGenerator;

    public function __construct(
        EntityManager $entityManager,
        HalResponseFactory $halResponseFactory,
        ResourceGenerator $resourceGenerator
    )
    {
        $this->entityManager      = $entityManager;
        $this->halResponseFactory = $halResponseFactory;
        $this->resourceGenerator  = $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $repository = $this->entityManager->getRepository(Login::class);

        $query = $repository
            ->createQueryBuilder('p')
            ->getQuery();


        $paginator = new Paginator($query);

        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);


        // return new JsonResponse($records[0]);

        $username = $request->getAttribute('username', null);
        $password = $request->getAttribute('password', null);

        if (in_array($username, $records[0])) {
            if (in_array($password, $records[0])) {
                return new JsonResponse("Middleware that handles token generation to take place here");
            } else {
                return new JsonResponse($records[0]);
            }
        } else {
            return new JsonResponse($records);
            return new JsonResponse("Sorry username not found");
        }


        /*
        $username = $request->getAttribute('id', null);
        $entityRepository = $this->entityManager->getRepository(Login::class);
        $entity = $entityRepository->find($username);

        if (empty($entity)) {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found';

            return new JsonResponse($result, 404);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        // return  $this->halResponseFactory->createResponse($request, $resource);



        */


    }
}
