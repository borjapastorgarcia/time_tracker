<?php


namespace App\Application\Create;


use App\Domain\TaskDetail;
use App\Domain\TaskRepository;

class TaskDetailCreator
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

        $task = TaskDetail::create($taskId, $name);
        $this->repository->save($task);
    }

}