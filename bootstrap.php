<?php

spl_autoload_register ( 'app_autoloader' );

function app_autoloader($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    
    include_once $className . '.php';
}