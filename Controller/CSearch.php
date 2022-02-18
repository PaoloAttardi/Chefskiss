<?php

/*require_once('../Foundation/FPersistentManager.php');
require_once('../Foundation/FRicetta.php');
require_once('../Entity/ERicetta.php');
require_once('../Foundation/Utility/USingleton.php');*/
class CSearch {

    static function homeView(){
        $pm = USingleton::getInstance('FPersistentManager');
        $ricetteVotate = $pm::search('FRicetta', array(), 'valutazione');
        /*for($i = 0; $i < count($ricetteVotate); $i++){
            //var_dump($ricetteVotate[$i]);
            echo json_encode($ricetteVotate[$i]);
        }*/
        echo json_encode($ricetteVotate);
    }
}