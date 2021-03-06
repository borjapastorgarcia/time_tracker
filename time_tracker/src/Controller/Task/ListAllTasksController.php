<?php


namespace App\Controller\Task;


use App\Application\Find\AllTasksFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListAllTasksController extends AbstractController
{

    public function index(
        AllTasksFinder $allTasksFinder
    )
    {

        $tasks = $allTasksFinder();

        return $this->render(
            'Task/tasks.html.twig',
            [
                'tasks' => $tasks,
                'activeItem' => 'list',
            ]
        );

    }

}