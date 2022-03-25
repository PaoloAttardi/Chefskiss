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

    static function isLogin(){
        if(CUtente::isLogged()){
            header('Location: /chefskiss2/index.html#/Profilo/0');
        }
        else header('Location: /chefskiss2/index.html#/Login/0');
    }

    static function verifica(){
        $utente = EPersona::loadLogin(VData::getEmail(), VData::getPassword());
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
            } elseif(CAdmin::restoreUser($utente[0]->getId())){
                if (USession::sessionStatus() == PHP_SESSION_NONE) {
                    $session = USingleton::getInstance('USession');
                    $savableData = serialize($utente[0]);
                    $privilegi = $utente[0]->getDiscr();
                    $session->setValue('privilegi', $privilegi);
                    $session->setValue('utente', $savableData);
                    header('Location: /chefskiss2/index.html#/Profilo/0');
                }
            } else header('Location: /chefskiss2/index.html#/Login/2');
        } else header('Location: /chefskiss2/index.html#/Login/1');
    }

    static function registrazione(){
        $pm = USingleton::getInstance('FPersistentManager');
        $verify_email = $pm::exist('email', VData::getEmail(), 'EUtente');
        if ($verify_email) {
            //aggiungere errore email già presente
        } else {
            $nome_utente = VData::getNome();
            $cognome_utente = VData::getCognome();
            $utente = new EUtente(false,null,null,$nome_utente, $cognome_utente,0, VData::getPassword(), 'descrizione',VData::getEmail());
            $pm::insert($utente);
            header('Location: /chefskiss2/index.html#/Profilo/0');
        }
    }


    static function logout()
    {
        $session = USingleton::getInstance('USession');
        $session->unsetSession();
        $session->destroySession();
        setcookie('PHPSESSID', '');
        header('Location: /chefskiss2/index.html#/Login/0');
    }
}