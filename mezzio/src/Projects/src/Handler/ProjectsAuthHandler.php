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
use ReallySimpleJWT\Token;

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

        $start = 0;
        foreach ($records as $username => $password)
        {
            $start += 1;
            if ($records["username"] = $username)
            {
                $passCheck = password_verify('e583799b852467HWeirdWords7f0cb11ca3c3', $records[$start]["password"]);
                if ($passCheck)
                {
                    $userId = $username;
                    $secret = 'sec!ReT423*&';
                    $expiration = time() + 3600;
                    $issuer = 'localhost';

                    $token = Token::create($userId, $secret, $expiration, $issuer);

                    return new JsonResponse($token);
                    // return new JsonResponse($records[$start]);
                } else {
                    return new JsonResponse($records[$start]["password"]);
                }
            }

        }
        return new JsonResponse("Sorry username not found");


        /*
          if (in_array($username, $records[0])) {
                if (in_array($password, $records[1])) {
                    return new JsonResponse("Middleware that handles token generation to take place here");
                } else {
                    return new JsonResponse($records[0]);
                }
            } else {
                return new JsonResponse($records);
                // return new JsonResponse("Sorry username not found");
            }
         */


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
