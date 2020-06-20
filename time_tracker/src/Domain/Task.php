<?php

declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Task
{
    private $id;
    private $name;
    private $taskDetails;

    public function __construct(
        string $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->taskDetails = new ArrayCollection();
    }

    public static function create(
        string $name
    ): self
    {

        $task = new self(
            RamseyUuid::uuid4()->toString(),
            $name
        );
        return $task;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getTaskDetails(): Collection
    {
        return $this->taskDetails;
    }

    /**
     * @param ArrayCollection $taskDetails
     */
    public function setTaskDetails(ArrayCollection $taskDetails): void
    {
        $this->taskDetails = $taskDetails;
    }



}