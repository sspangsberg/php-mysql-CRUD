<?php define("BASE_URL", "http://localhost/php-mysql-CRUD");

require_once "router.php";

route('/php-mysql-CRUD/', function () {
    require "views/MainView.php";
});

$action = $_SERVER['REQUEST_URI'];
//echo $action;

dispatch($action);
