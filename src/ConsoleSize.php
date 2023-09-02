<?php

namespace SchenkeIo\Terminal;

use Symfony\Component\Console;

class ConsoleSize
{
    public static function width(): int
    {
        return (new Console\Terminal())->getWidth();
    }

    public static function height(): int
    {
        return (new Console\Terminal())->getHeight();
    }
}
