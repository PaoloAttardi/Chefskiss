<?php
require 'Fdb.php';
require 'FCategoria.php';

$a=FCategoria::exist('idCategoria',1);
var_dump($a);
