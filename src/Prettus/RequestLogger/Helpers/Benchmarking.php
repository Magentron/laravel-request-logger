<?php

namespace Prettus\RequestLogger\Helpers;

/**
 * Class Benchmarking.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class Benchmarking
{
    /**
     * @var float[][]
     */
    protected static $timers = [];

    /**
     * @param string|int $name
     *
     * @return mixed
     */
    public static function start($name)
    {
        $start = microtime(true);

        static::$timers[$name] = [
            'start' => $start,
        ];

        return $start;
    }

    /**
     * @param string|int $name
     *
     * @throws \Exception
     *
     * @return float
     */
    public static function end($name)
    {
        $end = microtime(true);

        if (isset(static::$timers[$name], static::$timers[$name]['start'])) {
            if (isset(static::$timers[$name]['duration'])) {
                return static::$timers[$name]['duration'];
            }

            $start                             = static::$timers[$name]['start'];
            static::$timers[$name]['end']      = $end;
            static::$timers[$name]['duration'] = $end - $start;

            return static::$timers[$name]['duration'];
        }

        throw new \Exception("Benchmarking '{$name}' not started");
    }

    /**
     * @param string|int $name
     *
     * @throws \Exception
     *
     * @return float
     */
    public static function duration($name)
    {
        return static::end($name);
    }
}
