<?php

declare(strict_types=1);

namespace OnlineStore\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use OnlineStore\Entity\Login;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReallySimpleJWT\Token;

class StoreSignUpHandler implements RequestHandlerInterface
{
    private $entityManager;
    private $halResponseFactory;
    private $resourceGenerator;

    public function __construct(
        EntityManager       $entityManager,
        HalResponseFactory  $halResponseFactory,
        ResourceGenerator   $resourceGenerator
    )
    {
        $this->entityManager        =  $entityManager;
        $this->halResponseFactory   =  $halResponseFactory;
        $this->resourceGenerator    =  $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new JsonResponse("You did get here");

        $result = [];
        $requestBody = $request->getParsedBody()['Request']['SignUp'];

        if (empty($requestBody)) {
            $result['_error']['error'] = 'missing_request';
            $result['_error']['error_description'] = 'No request sent.';

            return new JsonResponse($result);
        }

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

        try {
            $entity->setUser($requestBody);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getLine();

            return new JsonResponse("In the catch");
        }

        $query = $repository
            ->createQueryBuilder('p')
            ->getQuery();

        $paginator = new Paginator($query);

        $records =$paginator
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($records as $key => $value)
        {
            if ($records[$key]["username"] == $requestBody["username"])
            {
                $userId = $records[$key]["username"];
                $secret = 'sec!ReT423*&';
                $expiration = time() + 3600;
                $issuer = 'localhost';
                $token = Token::create($userId, $secret, $expiration, $issuer);

                return new JsonResponse($token);
            }
        }

        return new JsonResponse("Nothing to see here");
        // Create and return a response
    }
}
