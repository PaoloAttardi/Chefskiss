<?php
require 'Fdb.php';
require 'FCategoria.php';
require '../Entity/ECategoria.php';

$categoria = new ECategoria('prova' , 00);
FCategoria::insert($categoria);
$a = FCategoria::exist('idCategoria',1);
var_dump($a);
