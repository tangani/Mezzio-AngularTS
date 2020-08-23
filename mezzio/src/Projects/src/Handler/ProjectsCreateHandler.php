<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Login;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsCreateHandler implements RequestHandlerInterface
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
        $requestBody = $request->getParsedBody()['Request']['Login'];

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = ' No request body sent.';

            return  new JsonResponse($result);
        }

        $entity = new Login();

        try {
            $entity->setUser($requestBody);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch(ORMException $e) {
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getLine();

            return new JsonResponse($result);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return  new JsonResponse($requestBody);

        // return $this->halResponseFactory->createResponse($request, $resource);
    }
}
