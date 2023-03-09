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
        $this->assertEquals('%1B%5B0%3B31m%1B%5B41mred%1B%5B0m', urlencode(ConsoleColor::red('red')));
    }

    public static function dataProviderCustomCalls(): array
    {
        return [
            # name             # method-name    isStyle   urlencoded result
            'color pair 1' => ['greenOnYellow', false, '%1B%5B0%3B32m%1B%5B43m%1B%5B42mgreenOnYellow%1B%5B0m'],
            'color pair 2' => ['redOnWhite', true, '%1B%5B1%3B31m%1B%5B47mredOnWhite%1B%5B0m'],
        ];

    }

    /**
     * @test
     * @dataProvider dataProviderCustomCalls
     * @param string $methodName
     * @param bool $isStyle
     * @param string $urlEncodedResult
     * @return void
     */
    public function test_custom_function_calls(
        string $methodName,
        bool   $isStyle,
        string $urlEncodedResult
    ): void
    {
        // should not be part of the styles
        $this->assertEquals($isStyle, isset(ConsoleColor::styles[$methodName]),
            "custom function should not be a style as well"
        );
        // should convert correctly
        $this->assertEquals(
            $urlEncodedResult,
            urlencode(ConsoleColor::$methodName($methodName))
        );
    }
}
