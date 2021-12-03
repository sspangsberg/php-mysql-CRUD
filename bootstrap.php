<?php

spl_autoload_register ( function ($class) {
    require_once "includes/db/DBConnector.php";
    require_once "models/BaseModel.php";
    require_once "models/ReviewModel.php";
    
    //require "includes/db/connection.php";
    
    //include str_replace('\\', '/', $class) . '.php';

    /*$sources = array("/controllers/$class.php", "/models/$class.php", "/views/$class.php" );
    
        foreach ($sources as $source) {
            if (file_exists($source)) {
                require $source;
            } 
        } 
    });
    */
});