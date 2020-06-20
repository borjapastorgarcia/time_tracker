<?php


namespace App\Application\Create;


use App\Domain\Task;
use App\Domain\TaskRepository;

class TaskCreator
{
    private $repository;

    public function __construct(
        TaskRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $name
    )
    {

        $task = Task::create($name);
        $this->repository->save($task);
    }

}