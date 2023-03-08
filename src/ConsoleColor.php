<?php
/**
 * PHP Colored CLI
 * Used to colorize strings in the console
 *
 * MIT Licensed
 * * http://opensource.org/licenses/MIT
 *
 * based on work from:
 * * https://ss64.com/nt/syntax-ansi.html
 * * https://github.com/sallar
 * * https://gist.github.com/sallar/5257396
 * * https://github.com/donatj
 * * https://gist.github.com/donatj/1315354
 *
 */

namespace SchenkeIo\Terminal;


/**
 * @method static successLine(string $string)
 * @method static warningLine(string $string)
 * @method static dangerLine(string $string)
 * @method static infoLine(string $string)
 * @method static defaultLine(string $string)
 * @method static successText(string $string)
 * @method static warningText(string $string)
 * @method static dangerText(string $string)
 * @method static infoText(string $string)
 * @method static defaultText(string $string)
 *
 */
class ConsoleColor
{
    protected const style = [
        'defaultLine' => ['withLineEnd'],
        'infoLine' => ['black', 'blue', 'withLineEnd'],
        'successLine' => ['black', 'green', 'withLineEnd'],
        'warningLine' => ['black', 'yellow', 'withLineEnd'],
        'dangerLine' => ['black', 'red', 'withLineEnd'],
        'defaultText' => [],
        'infoText' => ['black', 'blue'],
        'successText' => ['black', 'green'],
        'warningText' => ['black', 'yellow'],
        'dangerText' => ['black', 'red']
    ];

    protected const  foregroundColors = [
        'black' => '0;30', 'dark_gray' => '1;30',
        'blue' => '0;34', 'light_blue' => '1;34',
        'green' => '0;32', 'light_green' => '1;32',
        'cyan' => '0;36', 'light_cyan' => '1;36',
        'red' => '0;31', 'light_red' => '1;31',
        'purple' => '0;35', 'light_purple' => '1;35',
        'brown' => '0;33', 'yellow' => '1;33',
        'light_gray' => '0;37', 'white' => '1;37',
        'normal' => '0;39',
    ];

    protected const backgroundColors = [
        'black' => '40', 'red' => '41',
        'green' => '42', 'yellow' => '43',
        'blue' => '44', 'magenta' => '45',
        'cyan' => '46', 'light_gray' => '47',
    ];

    protected const options = [
        'bold' => '1', 'dim' => '2',
        'underline' => '4', 'blink' => '5',
        'reverse' => '7', 'hidden' => '8',
    ];


    /**
     * colorize a string for console output
     *
     * @param string $str text String
     * @param string $foreground
     * @return string colorized output
     */
    public static function colorize(
        string $str = '',
        string $foreground = 'normal'
    ): string
    {
        return self::$foreground($str);
    }


    /**
     *  echos all possible combinations
     *
     * @return void
     */
    public static function echoSelfTestAll(): void
    {
        foreach (self::backgroundColors as $bgName => $bgValue) {
            foreach (self::foregroundColors as $fgName => $fgValue) {
                echo "ConsoleColor::$fgName([text],'$bgName',[option]) => ";
                echo self::$fgName('null', $bgName) . " ";
                foreach (self::options as $optName => $optValue) {
                    echo self::$fgName($optName, $bgName, $optName) . " ";
                }
                echo "\n";
            }
        }
    }

    /**
     * echo all prepared styles
     * @return void
     */
    public static function echoSelfTestAllStyles(): void
    {
        foreach (self::style as $styleName => $styleValue) {
            echo "ConsoleColor::$styleName('$styleName) => ";
            echo self::$styleName($styleName);
            echo "\n";
        }
    }

    /**
     * allows for static method calls using any keys from
     * the 'style' or 'foreground' arrays
     *
     * @param string $name
     * @param array $args Options
     * @return string          Colored string
     */
    public static function __callStatic(string $name, array $args)
    {
        $withLineEnd = false;
        $string = $args[0];
        array_shift($args);
        $coloredString = "";
        // check if the name is a valid style name
        $autoArgs = self::style[$name] ?? false;
        if ($autoArgs) {
            $foregroundColor = array_shift($autoArgs);
            $args = array_merge($args, $autoArgs);
        } else {
            $foregroundColor = $name;
        }
        $coloredString .= self::escape(
            self::foregroundColors[$foregroundColor] ??
            self::foregroundColors['normal']
        );
        $backGroundColorOptions = array_merge(self::backgroundColors, self::options);
        foreach ($args as $arg) {
            $coloredString .= self::escape($backGroundColorOptions[$arg] ?? null);
            $withLineEnd = $withLineEnd || ($arg == 'withLineEnd');
        }

        // Add string and end coloring
        $coloredString .= $string . self::escape('0') . ($withLineEnd ? "\n" : '');
        return $coloredString;
    }

    /**
     * encapsulate the string with the escape sequences
     *
     * @param string|null $value
     * @return string
     */
    private static function escape(string|null $value): string
    {
        return is_null($value) ? '' : "\033[" . $value . "m";
    }

    /**
     * Plays a bell sound in console (if available)
     * @param integer $count Bell play count
     * @return void Bell play string
     */
    public static function bell(int $count = 1): void
    {
        echo str_repeat("\007", $count);
    }
}