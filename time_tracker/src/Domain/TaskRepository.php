<?php


namespace App\Domain;


interface TaskRepository
{

    public function save(Task $task);

    public function findSameName(string $taskName);

    public function findAll();

}