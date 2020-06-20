<?php


namespace App\Controller\Task;


use App\Tasks\Infrastructure\Persistence\MySqlTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListAllTasksController extends AbstractController
{
    private $mySqlTaskRepository;

    public function index(
        MySqlTaskRepository $mySqlTaskRepository
    ){
        $this->mySqlTaskRepository = $mySqlTaskRepository;

        $tasks = $this->mySqlTaskRepository->searchAll();

        return $this->render(
            'Task/tasks.html.twig',
            [
                'activeElement' => 'index',
                'tasks' => $tasks
            ]
        );

    }

}