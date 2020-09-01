<?php

declare(strict_types=1);

namespace Projects\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


/**
 * https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html
 *
 * @ORM\Entity
 * @ORM\Table(name="project_login")
 */
class Login
{
    /**
     * @var Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $surname;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $password;

    /**
     * @param array $requestBody
     * @throws \Exception
     */
    public function getUser(array $requestBody): array
    {
        return [
            'name'     => $this->getName(),
            'surname'  => $this->getSurname(),
            'email'    => $this->getEmail(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ];
    }

    /**
     * @param array $requestBody
     * @throws \Exception
     */
    public function setUser(array $requestBody): void
    {
        $this->setName($requestBody['name']);
        $this->setSurname($requestBody['surname']);
        $this->setEmail($requestBody['email']);
        $this->setUsername($requestBody['username']);
        $this->setPassword($requestBody['password']);
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }



    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password,
            PASSWORD_DEFAULT, array('cost' => 9));
    }
}