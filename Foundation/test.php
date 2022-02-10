<?php
require 'Fdb.php';
require 'FCategoria.php';
require '../Entity/ECategoria.php';


$azz = FCategoria::search(array(['categoria', '=', 'prova2']));
var_dump($azz);