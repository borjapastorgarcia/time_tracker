<?php


namespace App\Domain;


interface TaskDetailRepository
{

    public function save(TaskDetail $task);

    public function findActive();

}