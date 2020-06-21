<?php

namespace App\Controller\Task;

use App\Application\Create\TaskCreator;
use App\Application\Create\TaskDetailCreator;
use App\Application\Find\ActiveTaskDetailFinder;
use App\Application\Find\SameNameTaskFinder;
use App\Application\Stop\TaskDetailStopper;
use App\Domain\Task;
use App\Domain\TaskDetail;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateTaskController extends AbstractController
{

    public function index(
        Request $request,
        ActiveTaskDetailFinder $taskDetailFinder,
        SameNameTaskFinder $sameNameTaskFinder,
        TaskDetailCreator $taskDetailCreator,
        TaskDetailStopper $taskDetailStopper,
        TaskCreator $taskCreator
    )
    {

        $form = $this->createForm(TaskType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $sameNameTaskFinder->__invoke($form->get('name')->getData());

            $task ? $this->createTaskDetail(
                $task,
                $taskDetailCreator,
                $taskDetailStopper
            ) : $this->createTask(
                $form->get('name')->getData(),
                $taskCreator,
                $taskDetailCreator,
                $sameNameTaskFinder,
                $taskDetailStopper
            );

            return $this->redirectToRoute("create");
        }
        $activeTaskDetail = $taskDetailFinder->__invoke();
        return $this->render(
            'Task/create.html.twig',
            [
                'form' => $form->createView(),
                'activeItem' => 'create',
                'activeTask' => $activeTaskDetail,
                'elapsedTime' => $activeTaskDetail ? $activeTaskDetail->generateElapsedTime() : null
            ]
        );
    }

    public function createTaskDetail(
        Task $task,
        TaskDetailCreator $taskDetailCreator,
        TaskDetailStopper $taskDetailStopper
    )
    {
        $taskDetailStopper->__invoke();
        $taskDetailCreator->__invoke($task);
    }

    public function createTask(
        string $name,
        TaskCreator $taskCreator,
        TaskDetailCreator $taskDetailCreator,
        SameNameTaskFinder $sameNameTaskFinder,
        TaskDetailStopper $taskDetailStopper
    )
    {
        $taskCreator->__invoke($name);
        $task = $sameNameTaskFinder->__invoke($name);
        $taskDetailStopper->__invoke();
        $taskDetailCreator->__invoke($task);
    }
}