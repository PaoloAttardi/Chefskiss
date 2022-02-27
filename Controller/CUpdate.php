<?php


class CUpdate
{
    static function modificaProfilo(){
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        $email=VData::getEmail();
        $verify_email = $pm::exist('email', $email, 'FUtente');
        if(CUtente::isLogged()) {
            if ($verify_email) {
                $utente = $pm::search('FUtente', array(['email', '=',$email]));
                $nome = VData::getNome();
                $cognome = VData::getCognome();
                $description = VData::getDescription();
                if ($nome != $utente[0]->getName()) {
                    $pm::update('name', $nome, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
                if ($cognome != $utente[0]->getSurname()) {
                    $pm::update('surname', $cognome, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
                if ($description != $utente[0]->getDescription()) {
                    $pm::update('description', $description, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
            }else{
                $utente = unserialize($session->readValue('utente'));
                $email=VData::getEmail();
                $nome = VData::getNome();
                $cognome = VData::getCognome();
                $description = VData::getDescription();
                $pm::update('email', $email, 'idUser', $utente->getId(), FUtente::getClass());
                if ($nome != $utente->getName()) {
                    $pm::update('name', $nome, 'idUser', $utente->getId(), FUtente::getClass());
                }
                if ($cognome != $utente->getSurname()) {
                    $pm::update('surname', $cognome, 'idUser', $utente->getId(), FUtente::getClass());
                }
                if ($description != $utente->getDescription()) {
                    $pm::update('description', $description, 'idUser', $utente->getId(), FUtente::getClass());
                }
            }
            $u = unserialize($session->readValue('utente'));
            $utente=$pm::search('FUtente', array(['idUser', '=', $u->getId()]));
            $utente[0]->setName(VData::getNome());
            $utente[0]->setSurname(VData::getcognome());
            $utente[0]->setEmail(VData::getEmail());
            $savableData = serialize($utente[0]);
            $privilegi = $utente[0]->getDiscr();
            $session->setValue('privilegi', $privilegi);
            $session->setValue('utente', $savableData);
        }
        header('Location: index.html#/Login');
    }

    static function like($id){
        if(CUtente::isLogged()) {
            $pm = USingleton::getInstance('FPersistentManager');
            $session = USingleton::getInstance('USession');
            $utente = unserialize($session->readValue('utente'));
            $commento = $pm::search('FCommento', array(['idCommento', '=', $id]));
            $upvote = $commento[0]->getUpVote();
            $voti = $pm::search('FTabellaUpVote', array(['idCommento', '=', $id]));
            $arrayVoti = array();
            foreach ($voti as $v) {
                $arrayVoti[] = $v->getId();
            }
            if (in_array($utente->getId(), $arrayVoti)) {
                $exist = true;
            } else {
                $exist = false;
            }
            if (!$exist) {
                $coppia = new ETabellaUpVote($utente->getId(), $id);
                $pm::update('upVote', $upvote + 1, 'idCommento', $id, FCommento::getClass());
                $pm::insert($coppia);

            }

            header("Location: ../../index.html#/Post/" . $commento[0]->getidPost());
        }
        else    header('Location: index.html#/Login');
    }
}