<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;

use hisorange\BrowserDetect\Parser as Browser;

class BlockChrome implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isChrome()) {
            die("Access Denied! <br> HELP: change your browser(Google Chrome was blocked!)");
        }
    }
}
