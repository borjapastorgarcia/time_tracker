<?php


namespace App\Application\Stop;


use App\Application\Find\ActiveTaskDetailFinder;
use App\Domain\TaskDetail;
use App\Domain\TaskDetailRepository;

class TaskDetailStopper
{
    private $repository;
    private $taskDetailFinder;

    public function __construct(
        TaskDetailRepository $repository
    )
    {
        $this->repository = $repository;
        $this->taskDetailFinder = new ActiveTaskDetailFinder($repository);
    }

    public function __invoke()
    {

        $taskDetail = $this->taskDetailFinder->__invoke();

        if ($taskDetail) {
            $taskDetail->stop();
            $this->repository->save($taskDetail);
        }
    }

}