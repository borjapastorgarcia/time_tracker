<?php

declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid as RamseyUuid;


final class TaskDetail
{
    private $id;
    private $name;
    private $status;
    private $startedAt;
    private $stoppedAt;
    private $elapsedTime;
    private $task;

    public function __construct(
        ?string $id,
        string $name,
        bool $status,
        \DateTime $startedAt,
        ?\DateTime $stoppedAt,
        ?string $elapsedTime,
        Task $task
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->startedAt = $startedAt;
        $this->stoppedAt = $stoppedAt;
        $this->elapsedTime = $elapsedTime;
        $this->task = $task;
    }

    public static function create(
        Task $task
    ): self
    {

        $taskDetail = new self(
            RamseyUuid::uuid4()->toString(),
            $task->name(),
            true,
            new \DateTime(),
            null,
            null,
            $task
        );
        return $taskDetail;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function startedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function stoppedAt(): ?\DateTime
    {
        return $this->stoppedAt;
    }

    public function elapsedTime(): ?string
    {
        return $this->elapsedTime;
    }

    public function task(): Task
    {
        return $this->task;
    }

    public function stop(): void
    {
//        die("stop");

        $this->stoppedAt = new \DateTime();
        $this->elapsedTime = $this->generateElapsedTime();
        $this->status = false;
    }

    public function generateElapsedTime(): string
    {
        $expiry_time = $this->startedAt;
        $current_date = new \DateTime();
        $diff = $expiry_time->diff($current_date);
        $elapsedTime = $diff->format('%H:%I:%S');

        return $elapsedTime;
    }

}