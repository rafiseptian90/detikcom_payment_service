<?php

namespace Helpers;

class Randomize
{
    public static function generateRandomNumber(int $length) : string
    {
        $result = "";

        for ($i = 1; $i <= $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }
}