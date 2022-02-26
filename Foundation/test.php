<?php
require 'Fdb.php';
require 'FCategoria.php';
require 'FRicetta.php';
require '../Entity/ERicetta.php';
require '../Entity/ECategoria.php';


//$prova = FCategoria::search(array(['categoria', '=', 'prova2']), '', 0, 2);

//$prova2 = FCategoria::search(array(['categoria', '=', 'prova2']), '', count($prova['data']), $prova['total'] + 1);
$b = FCategoria::update('categoria', 'Dessert', 'idCategoria', 6);
//$c = FCategoria::exist('idCategoria', 5);

// il valore 'data' dell'array prova contiene tutti i risultati compresi tra i valori di offset e limite 
// il valore 'result' contiene invece il numero di risultati totali ottenuti dall'esecuzione della query


//var_dump($prova);
//var_dump($prova2['data']);

//$d=new DateTime('now');

 //$r= new ERicetta('farina','faicose',0,$d,1,'farina',4,1,0);
 //FRicetta::insert($r);



