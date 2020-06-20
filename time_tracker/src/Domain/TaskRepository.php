<?php


namespace App\Domain;


interface TaskRepository
{
    public function update(Task $task);

    public function save(Task $task);

    public function findSameName(string $taskName);

}