<?php


namespace App\Application\Find;


use App\Domain\Task;
use App\Domain\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;

class AllTasksFinder
{
    private $repository;

    public function __construct(
        TaskRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke
    (): ?array
    {
        return $this->repository->findAll();
    }
}