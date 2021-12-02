<?php

spl_autoload_register ( function ($class) {
    require "models/ReviewModel.php";
    require "includes/db/connection.php";
    
    /*$sources = array("/controllers/$class.php", "/models/$class.php", "/views/$class.php" );
    
        foreach ($sources as $source) {
            if (file_exists($source)) {
                require $source;
            } 
        } 
    });
    */
});