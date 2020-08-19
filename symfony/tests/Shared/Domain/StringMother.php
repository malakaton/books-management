<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Shared\Domain;

final class StringMother
{
    public static function random(): string
    {
        return MotherCreator::random()->word;
    }
}