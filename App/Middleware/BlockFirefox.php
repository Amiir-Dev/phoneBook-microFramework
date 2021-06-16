<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class BlockFirefox implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isFirefox()) {
            die("Access Denied! <br> HELP: change your browser(Firefox was blocked!)");
        }
    }
}
