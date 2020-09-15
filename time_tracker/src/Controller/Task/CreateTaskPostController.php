<?php

namespace App\Controller\Task;

use App\Application\Create\CreateTaskRequest;
use App\Application\Create\TaskCreator;
use App\Application\Create\TaskDetailCreator;
use App\Application\Find\ActiveTaskDetailFinder;
use App\Application\Find\SameNameTaskFinder;
use App\Application\Stop\TaskDetailStopper;
use App\Domain\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateTaskPostController extends AbstractController
{
    private $taskCreator;

    public function __construct(TaskCreator $taskCreator)
    {

        $this->taskCreator = $taskCreator;
    }

    public function __invoke(Request $request)
    {
        $name = $request->get('name');

        $this->taskCreator->__invoke(new CreateTaskRequest($name));

        return new Response("Task created-> " . $name, Response::HTTP_CREATED);
    }

    /*public function index(
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
                $taskDetailStopper,
                $taskDetailFinder
            ) : $this->createTask(
                $form->get('name')->getData(),
                $taskCreator,
                $taskDetailCreator,
                $sameNameTaskFinder,
                $taskDetailStopper,
                $taskDetailFinder
            );

            return $this->redirectToRoute("create");
        }

        $activeTaskDetail = $taskDetailFinder();

        return $this->render(
            'Task/create.html.twig',
            [
                'form' => $form->createView(),
                'activeItem' => 'create',
                'activeTask' => $activeTaskDetail,
                'elapsedTime' => $activeTaskDetail ? $activeTaskDetail->generateElapsedTime() : null
            ]
        );
    }*/

    public function createTaskDetail(
        Task $task,
        TaskDetailCreator $taskDetailCreator,
        TaskDetailStopper $taskDetailStopper,
        ActiveTaskDetailFinder $taskDetailFinder
    )
    {
        $activeTaskDetail = $taskDetailFinder();
        $taskDetailStopper($activeTaskDetail);
        $taskDetailCreator($task);
    }

    public function createTask(
        string $name,
        TaskCreator $taskCreator,
        TaskDetailCreator $taskDetailCreator,
        SameNameTaskFinder $sameNameTaskFinder,
        TaskDetailStopper $taskDetailStopper,
        ActiveTaskDetailFinder $taskDetailFinder
    )
    {
        $activeTaskDetail = $taskDetailFinder();
        $taskCreator($name);
        $task = $sameNameTaskFinder($name);
        $taskDetailStopper($activeTaskDetail);
        $taskDetailCreator($task);
    }
}