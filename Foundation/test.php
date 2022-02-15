<?php
require 'Fdb.php';
require 'FCategoria.php';
require '../Entity/ECategoria.php';


$prova = FCategoria::search(array(['categoria', '=', 'prova2']), '', 0, 2);

$prova2 = FCategoria::search(array(['categoria', '=', 'prova2']), '', count($prova['data']), $prova['total'] + 1);
//$b = FCategoria::update('categoria', 'ciao', 'idCategoria', 10);
//$c = FCategoria::exist('idCategoria', 5);

// il valore 'data' dell'array prova contiene tutti i risultati compresi tra i valori di offset e limite 
// il valore 'result' contiene invece il numero di risultati totali ottenuti dall'esecuzione della query

//var_dump($prova['data']);
//var_dump($prova2['data']);
var_dump($prova2['data'][0]->getCategoria());
