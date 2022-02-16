<?php

class CSearch {

    static function homeView(){
        $pm = USingleton::getInstance('FPersistentManager');
        $ricetteVotate = $pm::load('FRicetta', array(), 'valutazione');
        return json_encode($ricetteVotate);
    }
}