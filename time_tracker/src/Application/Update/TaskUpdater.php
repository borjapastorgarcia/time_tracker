<?php


namespace App\Application\Update;


use App\Domain\TaskDetail;
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
        Task $task
    )
    {
        $task = TaskDetail::create($task);
        $this->repository->save($task);
    }
}