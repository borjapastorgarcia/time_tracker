<?php


namespace App\Command;


use App\Application\Find\AllTasksFinder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResumeTasksCommand extends Command
{
    private $logger;
    private $allTasksFinder;

    public function __construct(
        LoggerInterface $logger,
        AllTasksFinder $allTasksFinder
    )
    {
        parent::__construct(null);
        $this->allTasksFinder = $allTasksFinder;
    }

    protected function configure()
    {
        $this->setName('TimeTracker:ResumeTasks')
            ->setDescription("Command that have to returns a list of all the tasks with their status, start time, end time and total elapsed time");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $tasks = $this->allTasksFinder->__invoke();
        //TODO refactor
        print_r($tasks);

    }
}