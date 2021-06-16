<?php

namespace App\Utilities;


class Assets
{


    public static function get(string $route)
    {
        return $_ENV['HOST'] . 'assets/' . $route;
    }

}

