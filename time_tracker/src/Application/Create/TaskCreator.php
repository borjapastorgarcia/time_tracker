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
        ?int $taskId,
        string $name
    )
    {
        //TODO define if create a task or taskDetail
        $task = Task::create($taskId, $name);
        $this->repository->save($task);
    }

}