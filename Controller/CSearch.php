<?php

/*require_once('../Foundation/FPersistentManager.php');
require_once('../Foundation/FRicetta.php');
require_once('../Entity/ERicetta.php');
require_once('../Foundation/Utility/USingleton.php');*/
class CSearch {

    static function homeRicette(){
        $pm = USingleton::getInstance('FPersistentManager');
        $ricetteVotate = $pm::search('FRicetta', array(), 'valutazione');
        VData::sendData($ricetteVotate);
    }

    static function homePost(){
        $pm = USingleton::getInstance('FPersistentManager');
        $domande = $pm::search('FPost', array(), 'dataPubblicazione');
        VData::sendData($domande);
    }
}