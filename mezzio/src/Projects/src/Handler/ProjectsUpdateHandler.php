<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Project;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsUpdateHandler implements RequestHandlerInterface
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
        $this->entityManager =      $entityManager;
        $this->halResponseFactory = $halResponseFactory;
        $this->resourceGenerator =  $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $requestBody = $request->getParsedBody()["Request"]["Projects"];

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request body sent.';

            return new JsonResponse($requestBody);
            // return  new JsonResponse($result, 400);
        }

        $entityRepository = $this->entityManager->getRepository(Project::class);

        $entity = $entityRepository->find($request->getAttribute('id'));

        if (empty($entity)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request body sent.';

            return new JsonResponse("Tag 3");
            // return  new JsonResponse($result, 400);
        }

        try {
            $entity->setProject($requestBody);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = $e->getMessage();
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return $this->halResponseFactory->createResponse($request, $resource);
    }
}
