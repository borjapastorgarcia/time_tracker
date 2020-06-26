<?php


namespace App\Controller\Task;


use App\Application\Find\ActiveTaskDetailFinder;
use App\Application\Stop\TaskDetailStopper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StopTaskController extends AbstractController
{
    public function index(
        TaskDetailStopper $taskDetailStopper,
        ActiveTaskDetailFinder $taskDetailFinder
    )
    {
        $activeTaskDetail = $taskDetailFinder();
        $taskDetailStopper($activeTaskDetail);

        return $this->redirectToRoute("create");
    }
}