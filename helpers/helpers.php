<?php


function site_url($route = '')
{
    return $_ENV['HOST'] . $route;
}

function assets_url($route = '')
{
    return site_url("assets/" . $route);
}

function view($path, $data = [])
{
    extract($data);
    $path = str_replace('.', '/', $path);
    $viewFullPath = BASE_PATH . "views/$path.php";
    include_once $viewFullPath;
}
function view_die($path, $data = [])
{
    view($path, $data);
    die();
}

function xss_clean($str)
{
    return filter_var(htmlspecialchars($str), FILTER_SANITIZE_STRING);
}

function strContains($str, $needle, $case_sensitive = 0)
{
    if ($case_sensitive)
        $pos = strpos($str, $needle);
    else
        $pos = stripos($str, $needle);

    return ($pos !== false) ? true : false;
}

function nice_dump($var)
{
    echo "<pre style='display: block; text-align: left; direction: ltr; background-color: #fff; border: 1px solid #b75520; border-left-width: 7px; border-radius: 5px; margin: 10px; padding: 10px 10px 0 10px !important; font-size: 17px !important;'>";
    var_dump($var);
    echo "</pre>";
}
function nice_dd($var)
{
    nice_dump($var);
    die();
}
