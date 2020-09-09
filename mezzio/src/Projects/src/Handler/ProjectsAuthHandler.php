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
        $rawPassword = $request->getAttribute('password', null);

        $start = 0;
        foreach ($records as $key => $value)
        {
            $start += 1;
            if ($records[$key]["username"] == $username)
            {
                $passCheck = password_verify($rawPassword, $records[$key]["password"]);

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
                    return new JsonResponse("Wrong password or username");
                }
            }

        }
        // return new JsonResponse($records[$key]);
        return new JsonResponse("Wrong password or username");
    }
}
