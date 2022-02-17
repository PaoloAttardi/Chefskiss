<?php

require_once 'autoload.php';


$path = $_GET['url'];
$fcontroller = new CFrontController();
$fcontroller->run($path);