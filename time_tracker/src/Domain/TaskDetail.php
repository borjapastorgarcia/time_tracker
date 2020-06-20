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
    private $task;

    public function __construct(
        ?string $id,
        string $name,
        bool $status,
        \DateTime $startedAt,
        ?\DateTime $stoppedAt,
        string $task
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->startedAt = $startedAt;
        $this->stoppedAt = $stoppedAt;
        $this->task = $task;
    }

    public static function create(
        string $name,
        string $task
    ): self
    {

        $taskDetail = new self(
            RamseyUuid::uuid4()->toString(),
            $name,
            true,
            new \DateTime(),
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

    public function stop(): void
    {
        $this->stoppedAt = new \DateTime();
        $this->status = false;
    }

}