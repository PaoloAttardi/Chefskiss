<?php


class CAdmin
{
    static function isModerator(){
        if(CUtente::isLogged()) {
            $session = USingleton::getInstance('USession');
            $pm = USingleton::getInstance('FPersistentManager');
            $utente = unserialize($session->readValue('utente'));
            $moderator = $pm::search('FModeratore', array(['idUser', '=', $utente->getId()]));
            if ($moderator) {
                return $moderator[0]->getId();
            } else return false;
        }else  header('Location: ../index.html#/Login/0');
    }

    static function isAdmin(){
        if(CUtente::isLogged()) {
            $session = USingleton::getInstance('USession');
            $pm=USingleton::getInstance('FPersistentManager');
            $utente = unserialize($session->readValue('utente'));
            $admin=$pm::search('FAdmin',array(['idUser', '=', $utente->getId()]));
            if($admin){
                return $admin[0]->getId();
            }
            else return false;
        }else  header('Location: ../index.html#/Login/0');
    }

    /**
     * Il ban ha durata fissa di una settimana
     */
    static function banUser($idUser){
        if(self::isModerator() || self::isAdmin()){
            $pm = USingleton::getInstance('FPersistentManager');
            $session = USingleton::getInstance('USession');
            $utente = unserialize($session->readValue('utente'));
            $pm::update('ban',1,'idUser',$idUser,FUtente::getClass());
            $dataFineBan= new DateTime('now + 604.800 sec');
            $pm::update('dataFineBan',$dataFineBan,'idUser',$idUser,FUtente::getClass());
            $pm::update('idModerator',$utente->getId(),'idUser',$idUser,FUtente::getClass());
        }
    }

    static function restoreUser($idUser){
        $pm = USingleton::getInstance('FPersistentManager');
        $utente=$pm::search('FUser',array(['idUser','=',$idUser]));
        $currentDate=new DateTime('now');
        if($currentDate>= $utente->getDataFineBan()){
            $pm::update('ban',0,'idUser',$idUser,FUtente::getClass());
            $pm::update('dataFineBan',null,'idUser',$idUser,FUtente::getClass());
            $pm::update('idModerator',null,'idUser',$idUser,FUtente::getClass());
            return true;
        }
        else {
            return false;
        }
    }

    static function promozioneModeratore(){
        
    }
}