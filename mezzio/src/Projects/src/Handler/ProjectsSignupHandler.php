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

class ProjectsSignupHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $halResponseFactory;
    protected $resourceGenerator;

    public function __construct(
        EntityManager       $entityManager,
        HalResponseFactory  $halResponseFactory,
        ResourceGenerator   $resourceGenerator
    )
    {
        $this->entityManager      = $entityManager;
        $this->halResponseFactory = $halResponseFactory;
        $this->resourceGenerator  = $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $result = [];
        $requestBody = $request->getParsedBody()['Request']['SignUp'];

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request sent.';

            return new JsonResponse($result);
        }

        $entity = new Login();

        /*
        $repository = $this->entityManager->getRepository(Login::class);

        $query = $repository
            ->createQueryBuilder('p')
            ->getQuery();

        $paginator = new Paginator($query);

        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $recent = end($records);
        $newId = $recent['id'];
        $idArray = explode("-", (string)$newId);
        $firstUuid = $idArray[0];
        $endUuid = end($idArray);



        return new JsonResponse($endUuid);

        */


        try {
            $entity->setUser($requestBody);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getLine();

            return new JsonResponse($result);
        }

        // $resource = $this->resourceGenerator->fromObject($entity, $request);
        return new JsonResponse($requestBody["username"]);
        // Create and return a response
    }
}
