<?php 

// modify the BASE_URL value to match your folder
//define("BASE_URL", "http://localhost/php-mysql-crud"); 
define("BASE_URL", "http://learningeachday.tech/php-mysql-crud"); 

require_once "router.php";

route('/php-mysql-crud/', function () {
    require "views/MainView.php";
});

$action = $_SERVER['REQUEST_URI'];
//echo $action;

dispatch($action);
