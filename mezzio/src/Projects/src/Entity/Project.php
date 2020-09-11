<?php

declare(strict_types=1);

namespace Projects\Entity;

use Doctrine\ORM\Mapping as ORM;

class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $manager;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $start;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $end;

    public function getProject(array $requestBody): array
    {
        return [
            'id'        => $this->getId(),
            'manager'   => $this->getManager(),
            'status'    => $this->getStatus(),
            'start'     => $this->getStart()->format('Y-m-d H:i:s'),
            'end'       => $this->getEnd()->format('Y-m-d H:i:s')
            ];
    }

    /**
     * @param array $requestBody
     */
    public function setProject(array $requestBody): void
    {
        $this->setTitle($requestBody['title']);
        $this->setManager($requestBody['manager']);
        $this->setStatus($requestBody['status']);
        // $this->setStart($requestBody['start']);
        // $this->setEnd($requestBody['end']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getManager(): string
    {
        return $this->manager;
    }

    /**
     * @param string $manager
     */
    public function setManager(string $manager): void
    {
        $this->manager = $manager;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @param DateTIME $start
     * @Assert\NotNull
     * @throws Exception
     */
    public function setStart(\DateTime $start = null): void
    {
        if (!$start && empty($this->getId())) {
            $this->start = new \DateTime("now");
        } else {
            $this->start = $start;
        }
    }

    /**
     * @return DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    /**
     * @param DateTime $end
     * @throws Exception
     */
    public function setEnd(\DateTime $end = null): void
    {
        if (!$end && empty($this->getId())) {
            $this->end = new \DateTime("2100-01-01");
        } else {
            $this->end = $end;
        }
    }
}