<?php

declare(strict_types=1);

namespace OnlineStore\Handler;

use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use OnlineStore\Entity\Login;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class StoreLoginHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $halResourceFactory;
    protected $resourceGenerator;

    /**
     * AnnouncementsViewHandler constructor.
     * @param EntityManager $entityManager
     * @param HalResponseFactory $halResponseFactory
     * @param ResourceGenerator $resourceGenerator
     */
    public function __construct(
        EntityManager       $entityManager,
        HalResponseFactory  $halResponseFactory,
        ResourceGenerator   $resourceGenerator
    )
    {
        $this->entityManager      =  $entityManager;
        $this->halResourceFactory =  $halResponseFactory;
        $this->resourceGenerator  =  $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id         = $request->getAttribute('id', null);
        $repository = $this->entityManager->getRepository(Login::class);
        $entity     = $repository->find($id);

        if (empty($entity)) {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found';

            return  new JsonResponse($result, 400);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return  $this->halResourceFactory->createResponse($request, $resource);
        // Create and return a response
    }
}
