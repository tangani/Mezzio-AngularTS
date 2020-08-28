<?php

declare(strict_types=1);

namespace Projects\Handler;

use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Projects\Entity\Project;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProjectsReadHandler implements RequestHandlerInterface
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
        $this->resourceGenerator  = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id = $request->getAttribute('id', null);
        $entityRepository = $this->entityManager->getRepository(Project::class);
        $entity = $entityRepository->find($id);

        if (empty($entity)) {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found';

            return new JsonResponse($result, 404);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return  $this->halResponseFactory->createResponse($request, $resource);

    }
}
