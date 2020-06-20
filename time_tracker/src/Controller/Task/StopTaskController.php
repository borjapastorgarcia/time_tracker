<?php


namespace App\Controller\Task;


use App\Application\Stop\TaskDetailStopper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StopTaskController extends AbstractController
{
    public function index(
        Request $request,
        TaskDetailStopper $taskDetailStopper
    )
    {
        $taskDetailStopper->__invoke();

        return $this->redirectToRoute("create");
    }
}