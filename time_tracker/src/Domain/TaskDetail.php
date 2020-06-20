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

    public function __construct(
        ?string $id,
        string $name,
        bool $status,
        \DateTime $startedAt,
        \DateTime $stoppedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->startedAt = $startedAt;
        $this->stoppedAt = $stoppedAt;
    }

    public static function create(
        ?string $id,
        string $name,
        bool $status,
        \DateTime $startedAt,
        \DateTime $stoppedAt
    ): self
    {

        $task = new self(
            RamseyUuid::uuid4()->toString(),
            $name,
            $status,
            $startedAt,
            $stoppedAt
        );
        return $task;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

}