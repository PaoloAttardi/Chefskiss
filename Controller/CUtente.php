<?php

class CUtente{

    static function login(){
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (static::isLogged()) {
                $utente = $_SESSION['utente'];
                VData::sendData(unserialize($utente));
            } else {
                $utente = array('check', false);
                VData::sendData($utente);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST")
            static::verifica();
    }

    static function isLogged(){
        $check = false;
        if (isset($_COOKIE['PHPSESSID'])) {
            if (USession::sessionStatus() == PHP_SESSION_NONE) {
                USingleton::getInstance('USession');
            }
        }
        if (isset($_SESSION['utente'])) {
            $check = true;
        }
        return $check;
    }

    static function verifica(){
        $pm = USingleton::getInstance('FPersistentManager');
        $utente = $pm->loadLogin(VData::getEmail(), VData::getPassword());
        if ($utente != null) {
            if ($utente[0]->getBan() != true) {
                if (USession::sessionStatus() == PHP_SESSION_NONE) {
                    $session = USingleton::getInstance('USession');
                    $savableData = serialize($utente[0]);
                    $privilegi = $utente[0]->getDiscr();
                    $session->setValue('privilegi', $privilegi);
                    $session->setValue('utente', $savableData);
                    header('Location: /chefskiss2/index.html#/Profilo/0');
                }
            } else VData::sendData($utente->getDataFineBan());    
        } else VData::sendData('Nome Utente o Password errati');
    }
}