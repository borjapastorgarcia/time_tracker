<?php

declare(strict_types=1);


namespace App\Tasks\Infrastructure\Persistence;

use App\Domain\TaskDetail;
use App\Domain\TaskDetailRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class MySqlTaskDetailRepository extends DoctrineRepository implements TaskDetailRepository
{

    public function save(TaskDetail $taskDetail): void
    {

        $this->persist($taskDetail);
    }


    public function findActive(): ?TaskDetail
    {
        return $this->repository(TaskDetail::class)->findOneBy([
            'status' => 1
        ]);
    }
}