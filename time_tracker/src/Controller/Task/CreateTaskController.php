<?php

namespace App\Controller\Task;

use App\Application\Create\TaskCreator;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateTaskController extends AbstractController
{
    private $mySqlTaskRepository;

    public function index(
        Request $request,
        TaskCreator $taskCreator
    )
    {

        $form = $this->createForm(TaskType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $taskCreator->__invoke(
                null,
                $form->get('name')->getData(),
                null,
                new \DateTime(),
                null
            );
            return $this->redirectToRoute("create");
        }

        return $this->render(
            'Task/create.html.twig',
            [
                'form' => $form->createView(),
                'activeElement' => 'index'
            ]
        );
    }
}