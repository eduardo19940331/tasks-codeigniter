<?php

namespace App\Helpers;

use DateTime;

class Date
{

    protected static DateTime $date;

    public function __construct(?string $date = null)
    {
        self::$date = new DateTime($date);
    }

    public static function formatMySQL()
    {
        return self::$date->format('Y-m-d H:i:s');
    }

    public static function formatEuropean()
    {
        return self::$date->format('d/m/Y H:i:s');
    }

    public static function formatAmerican()
    {
        return self::$date->format('m/d/Y H:i:s');
    }

    /**
     * Sumar días a una fecha
     */
    public static function addDay(int $days)
    {
        return static::$date->modify('+' . $days . ' day');
    }

    public static function changeToDate()
    {
        return self::$date;
    }
}
