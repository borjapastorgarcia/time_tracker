<?php


namespace App\Application\Create;


use App\Domain\Task;
use App\Domain\TaskId;
use App\Domain\TaskName;
use App\Domain\TaskRepository;
use App\Shared\Domain\ValueObject\Uuid;

class TaskCreator
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateTaskRequest $request)
    {
        $name = new TaskName($request->name());

        //$id = new TaskId();
        //$value = TaskId::random();

        $task = new Task(
            Uuid::random()->value(),
            $name
        );
        $this->repository->save($task);
    }

}