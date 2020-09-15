<?php

declare(strict_types=1);


namespace App\Domain;


use App\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

final class TaskName extends StringValueObject
{
    public function __construct(string $value)
    {

        $this->guardEnsureIsValidName($value);

        parent::__construct($value);

    }

    private function guardEnsureIsValidName(string $value)
    {
        if ($value == null) {
            throw new InvalidArgumentException(sprintf('Task need a name'));
        }

        if (strlen($value)<3) {
            throw new InvalidArgumentException(sprintf('TaskName must be bigger'));
        }
    }
}