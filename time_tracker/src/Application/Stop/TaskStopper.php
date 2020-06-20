<?php


namespace App\Application\Stop;


use App\Domain\Task;
use App\Domain\TaskRepository;

class TaskStopper
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
        //TODO stop taskDetail
        $task = Task::create($taskId, $name);
        $this->repository->save($task);
    }

}