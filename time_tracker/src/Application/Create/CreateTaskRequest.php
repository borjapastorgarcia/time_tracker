<?php

declare(strict_types=1);


namespace App\Application\Create;


final class CreateTaskRequest
{
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }


}