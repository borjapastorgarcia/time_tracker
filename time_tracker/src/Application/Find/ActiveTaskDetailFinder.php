<?php


namespace App\Application\Find;


use App\Domain\TaskDetail;
use App\Domain\TaskDetailRepository;

class ActiveTaskDetailFinder
{
    private $repository;

    public function __construct(
        TaskDetailRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke
    (): ?TaskDetail
    {
        return $this->repository->findActive();
    }

}