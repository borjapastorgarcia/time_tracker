<?php


namespace App\Application\Create;


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
        string $name,
        ?string $taskId
    )
    {
        $this->repository->save(TaskDetail::create($name, $taskId));
    }

}