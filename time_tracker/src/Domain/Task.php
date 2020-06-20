<?php

declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid as RamseyUuid;


final class Task
{
    private $id;
    private $name;
    private $detail;
    private $createdAt;
    private $stoppedAt;

    public function __construct(
        ?string $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(
        ?string $id,
        string $name
    ): self
    {

        $task = new self(
            RamseyUuid::uuid4()->toString(),
            $name
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