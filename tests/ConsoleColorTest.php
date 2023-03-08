<?php

namespace SchenkeIo\Terminal;

use PHPUnit\Framework\TestCase;

class ConsoleColorTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function test_simple_color_function(): void
    {
        $this->assertEquals('%1B%5B0%3B31mtest%1B%5B0m', urlencode(ConsoleColor::colorize('test', 'red')));
    }


}
