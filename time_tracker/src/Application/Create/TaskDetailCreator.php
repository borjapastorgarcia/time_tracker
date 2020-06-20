<?php


namespace App\Application\Create;


use App\Domain\Task;
use App\Domain\TaskDetail;
use App\Domain\TaskDetailRepository;

class TaskDetailCreator
{
    private $repository;

    public function __construct(
        TaskDetailRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        Task $task
    )
    {
        $this->repository->save(TaskDetail::create($task));
    }

}