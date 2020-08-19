<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Shared\Infrastructure\PhpUnit;

use BooksManagement\Shared\Domain\Command;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function dispatch(Command $command, callable $commandHandler)
    {
        return $commandHandler($command);
    }
}