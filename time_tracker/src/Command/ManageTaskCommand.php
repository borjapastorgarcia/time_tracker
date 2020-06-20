<?php


namespace App\Command;


use App\Application\Create\TaskCreator;
use App\Application\Create\TaskDetailCreator;
use App\Application\Find\SameNameTaskFinder;
use App\Application\Stop\TaskDetailStopper;
use App\Domain\Task;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ManageTaskCommand extends Command
{

    private $logger;
    private $taskCreator;
    private $taskDetailCreator;
    private $taskDetailStopper;
    private $sameNameTaskFinder;

    public function __construct(
        LoggerInterface $logger,
        TaskCreator $taskCreator,
        TaskDetailCreator $taskDetailCreator,
        TaskDetailStopper $taskDetailStopper,
        SameNameTaskFinder $sameNameTaskFinder
    )
    {
        parent::__construct(null);
        $this->logger = $logger;
        $this->taskCreator = $taskCreator;
        $this->taskDetailCreator = $taskDetailCreator;
        $this->sameNameTaskFinder = $sameNameTaskFinder;
        $this->taskDetailStopper = $taskDetailStopper;
    }

    protected function configure()
    {
        $this->setName('TimeTracker:ManageTasks')
            ->setDescription("Command that that receives by parameter the action (start / end) and the name of the task")
            ->addArgument('action', InputArgument::REQUIRED, 'Who do you want to do? Options \'start\' or \'end\'')
            ->addArgument('task', InputArgument::REQUIRED, 'The name of the task');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $action = trim($input->getArgument('action'));

        $taskName = trim($input->getArgument('task'));

        switch ($action) {
            case 'start':
                $task = $this->sameNameTaskFinder->__invoke($taskName);
                $task ? $this->createTaskDetail($task, $this->taskDetailCreator, $this->taskDetailStopper) : $this->createTask($taskName, $this->taskCreator, $this->taskDetailCreator, $this->sameNameTaskFinder, $this->taskDetailStopper);
                break;
            case 'stop':
                $this->taskDetailStopper->__invoke();
                break;
        }

        $this->logger->info('Executing command ...');

    }

    //TODO REFORMAT CODE AS A SERVICE
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