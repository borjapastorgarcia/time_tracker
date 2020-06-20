<?php


namespace App\Domain;


interface TaskDetailRepository
{
    public function update(TaskDetail $task);

    public function save(TaskDetail $task);

    public function findActive();

}