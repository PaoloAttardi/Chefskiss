<?php
require 'Fdb.php';
require 'FCategoria.php';
require '../Entity/ECategoria.php';


//$azz = FCategoria::loadByField(array(['categoria', '=', 'prova2']));
$a = new EUtente(false, null, null, 'prova', 'cognome', 1, 'password', 'ciao', 'email');
FUtente::insert($a);
FUtente::exist('idUser', 1);
var_dump($a);