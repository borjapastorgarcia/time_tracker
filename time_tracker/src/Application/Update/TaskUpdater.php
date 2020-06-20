<?php


namespace App\Application\Update;


use App\Domain\Task;
use App\Domain\TaskRepository;

class TaskUpdater
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
        string $name,
        ?string $detail,
        ?string $taskCreatedAt,
        ?string $taskStoppedAt
    )
    {
        //TODO definir si create or update
        $task = Task::create($taskId, $name, $detail, $taskCreatedAt, $taskStoppedAt);
        $this->repository->save($task);
    }
}