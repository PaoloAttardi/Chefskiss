<?php

require_once 'autoload.php';

if(isset($_GET['url']))$path = $_GET['url'];
else $path = $_SERVER['REQUEST_URI'];
$fcontroller = new CFrontController();
$fcontroller->run($path);
