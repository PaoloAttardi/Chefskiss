<?php

require_once 'autoload.php';

$fcontroller = new CFrontController();
$fcontroller->run($_SERVER['REQUEST_URI']);
