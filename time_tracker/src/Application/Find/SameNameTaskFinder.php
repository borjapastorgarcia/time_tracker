<?php


namespace App\Application\Find;


use App\Domain\Task;
use App\Domain\TaskRepository;

class SameNameTaskFinder
{
    private $repository;

    public function __construct(
        TaskRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke
    (
        string $name
    ):?Task
    {
        return $this->repository->findSameName($name);
    }

}