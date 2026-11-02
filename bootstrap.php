<?php

spl_autoload_register ( 'app_autoloader' );

function app_autoloader($class)
{
    $file = __DIR__ . '/' . $class;

    if (file_exists($file)) {
        include_once($file);
    }
}