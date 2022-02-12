<?php
require 'Fdb.php';
require 'FCategoria.php';
require '../Entity/ECategoria.php';


$azz = FCategoria::search(array(['categoria', '=', 'prova2']), '', 0, 2);

$azz2 = FCategoria::search(array(['categoria', '=', 'prova2']), '', count($azz['data']), $azz['total'] + 1);
//$b = FCategoria::update('categoria', 'ciao', 'idCategoria', 10);
//$c = FCategoria::exist('idCategoria', 5);

// il valore 'data' dell'array azz contiene tutti i risultati compresi tra i valori di offset e limite 
// il valore 'result' contiene invece il numero di risultati totali ottenuti dall'esecuzione della query

var_dump($azz['data']);
var_dump($azz2['data']);