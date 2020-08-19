<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks;

use Prophecy\Prophecy\ObjectProphecy;

abstract class Mock
{
    protected ObjectProphecy $prophecy;

    public function __construct(ObjectProphecy $prophecy)
    {
        $this->prophecy = $prophecy;
    }

    public function reveal()
    {
        return $this->prophecy->reveal();
    }
}