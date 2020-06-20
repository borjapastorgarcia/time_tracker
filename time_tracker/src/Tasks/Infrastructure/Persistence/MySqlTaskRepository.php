<?php

declare(strict_types=1);


namespace App\Tasks\Infrastructure\Persistence;

use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class MySqlTaskRepository extends DoctrineRepository implements TaskRepository
{

    public function save(Task $task): void
    {

        $this->persist($task);
    }

    public function searchAll(): array
    {
        return $this->repository(Task::class)->findAll();
    }

    public function update(Task $task)
    {
        return $this->repository(Task::class)->update();
    }
}