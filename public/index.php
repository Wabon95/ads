<?php

session_start();

require '../vendor/autoload.php';
require '../config.php';
require '../src/Routes.php';

if ($match = $router->match())
{
    list($controller, $action) = explode('#', $match['target']);
    call_user_func_array([new $controller, $action], $match['params']);
}
elseif ($match === false)
{
    header('HTTP/1.0 404 Not Found');
    echo '404';
}