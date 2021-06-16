<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;


class GlobalMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        $this->sanitizeGetParams();
    }

    public function sanitizeGetParams()
    {
        foreach ($_GET as $key => $value) {
            $_GET[$key] = xss_clean($value);
        }
    }
}

// $global_middlewares = [
//     'global' => [
//         " BlockIE::class",
//         "BlockChrome::class",
//         "BlockFirefox::class"
//     ]
// ];
