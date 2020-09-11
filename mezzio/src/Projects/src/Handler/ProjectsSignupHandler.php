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
use ReallySimpleJWT\Token;

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

    private function checkIfUserExists($requestBody): ResponseInterface
    {
            return  new JsonResponse($requestBody);
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        return new JsonResponse("You did get here");

        $result = [];
        $requestBody = $request->getParsedBody()['Request']['SignUp'];

        return $this->checkIfUserExists($requestBody);

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request sent.';

            return new JsonResponse($result);
        }

        // return new JsonResponse($requestBody);

        $entity = new Login();

        $repository = $this->entityManager->getRepository(Login::class);

        $query = $repository
            ->createQueryBuilder('p')
            ->getQuery();

        $paginator = new Paginator($query);

        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($records as $key => $value)
        {
            if ($records[$key]["username"] == $requestBody['username'])
            {
                $takenUsername = $requestBody['username'].": username already taken";
                return new JsonResponse($takenUsername);
            }
        }

        /*
        return new JsonResponse(gettype($requestBody));

        // return new JsonResponse($requestBody["username"]);
        $userId = $records[0]["username"];
        $secret = 'sec!ReT423*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';
        $token = Token::create($userId, $secret, $expiration, $issuer);

        return new JsonResponse($token);
        */


        // Set user function used to add new user
        try {
            // return new JsonResponse($requestBody["username"]);
            $entity->setUser($requestBody);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            // return new JsonResponse("Just flushed");
        } catch (ORMException $e) {
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getLine();

            return new JsonResponse("In the catch");
            // return new JsonResponse($result);
        }

        // return new JsonResponse("Done...");


        // $resource = $this->resourceGenerator->fromObject($entity, $request);


        $query = $repository
            ->createQueryBuilder('p')
            ->getQuery();

        $paginator = new Paginator($query);

        $records = $paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($records as $key => $value)
        {
            if ($records[$key]["username"] == $requestBody['username'])
            {
                // $takenUsername = $requestBody['username'].": username already taken";
                $userId = $records[$key]["username"];
                $secret = 'sec!ReT423*&';
                $expiration = time() + 3600;
                $issuer = 'localhost';
                $token = Token::create($userId, $secret, $expiration, $issuer);

                return new JsonResponse($token);
            }
        }
    }
}
