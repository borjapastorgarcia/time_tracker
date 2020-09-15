<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Task
{
    private $id;
    private $name;
    private $taskDetails;

    public function __construct(string $id, TaskName $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->taskDetails = new ArrayCollection();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function taskDetails(): Collection
    {
        return $this->taskDetails;
    }

    public function setTaskDetails(ArrayCollection $taskDetails): void
    {
        $this->taskDetails = $taskDetails;
    }


}