<?php

class Helper
{
    /**
     * Переводит время из unixtime в привычное человеку
     * @param $time
     * @return string
     */
    public static function getDateFromTime($time)
    {
        return date('H:i d.m.Y', $time);
    }
}
