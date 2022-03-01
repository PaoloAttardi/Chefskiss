<?php


class CUpdate
{
    static function modificaProfilo()
    {
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        $email = VData::getEmail();
        $verify_email = $pm::exist('email', $email, 'FUtente');
        if (CUtente::isLogged()){
            if ($verify_email) {
                $utente = $pm::search('FUtente', array(['email', '=', $email]));
                $nome = VData::getNome();
                $cognome = VData::getCognome();
                $description = VData::getDescription();
                if ($nome != $utente[0]->getName()) {
                    $pm::update('name', $nome, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
                $id_immagine = self::upload();
                if($id_immagine){
                    $pm::update('idImmagine', $id_immagine,'idUser',$utente[0]->getId(),FUtente::getClass());
                    $pm::delete('idImmagine',$utente[0]->getidImmagine(),FImmagine::getClass());
                }
                if ($cognome != $utente[0]->getSurname()) {
                    $pm::update('surname', $cognome, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
                if ($description != $utente[0]->getDescription()) {
                    $pm::update('description', $description, 'idUser', $utente[0]->getId(), FUtente::getClass());
                }
            } else {
                $utente = unserialize($session->readValue('utente'));
                $email = VData::getEmail();
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
                $id_immagine = self::upload();
                if($id_immagine){
                    $pm::update('idImmagine',$id_immagine,'idUser',$utente->getId(),FUtente::getClass());
                    $pm::delete('idImmagine',$utente->getidImmagine(),FImmagine::getClass());
                }
                if ($description != $utente->getDescription()) {
                    $pm::update('description', $description, 'idUser', $utente->getId(), FUtente::getClass());
                }
            }
            $u = unserialize($session->readValue('utente'));
            $utente = $pm::search('FUtente', array(['idUser', '=', $u->getId()]));
            $utente[0]->setName(VData::getNome());
            if($id_immagine!=false){
                $utente[0]->setidImmagine($id_immagine);
            }
            $utente[0]->setSurname(VData::getcognome());
            $utente[0]->setEmail(VData::getEmail());
            $savableData = serialize($utente[0]);
            $privilegi = $utente[0]->getDiscr();
            $session->setValue('privilegi', $privilegi);
            $session->setValue('utente', $savableData);
            header('Location: /chefskiss2/index.html#/Profilo/0');
        }
        else header('Location: ../index.html#/Login/0');
    }

    static function like($id)
    {
        if (CUtente::isLogged()) {
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
        } else    header('Location: ../../index.html#/Login/0');
    }

    static function modificaRicetta($id)
    {
        if (CUtente::isLogged()) {
            $pm = USingleton::getInstance('FPersistentManager');
            $oldRicetta = $pm::search('FRicetta', array(['idRicetta', '=', $id]));
            if ($oldRicetta[0]->getNomeRicetta() != VData::getTitoloRicetta()) {
                $pm::update('nomeRicetta', VData::getTitoloRicetta(), 'idRicetta', $id, FRicetta::getClass());
            }
            if ($oldRicetta[0]->getProcedimento() != VData::getProcedimentoRicetta()) {
                $pm::update('procedimento', VData::getProcedimentoRicetta(), 'idRicetta', $id, FRicetta::getClass());
            }
            $id_immagine = self::upload();
            if($id_immagine){
                $pm::delete('idImmagine',$oldRicetta[0]->getidImmagine(),FImmagine::getClass());
                $pm::update('idImmagine',$id_immagine,'idRicetta',$id,FRicetta::getClass());
            }
            $oldIngredienti = unserialize($oldRicetta[0]->getIngredienti());
            $newIngredienti = VData::getIngredientiRicetta();
            unset($newIngredienti[count($newIngredienti) - 1]);
            if ($oldIngredienti != $newIngredienti) {
                $pm::update('ingredienti', serialize($newIngredienti), 'idRicetta', $id, FRicetta::getClass());
            }
            if ($oldRicetta[0]->getCategoria() != VData::getCategoriaRicetta()) {
                $pm::update('categoria', VData::getCategoriaRicetta(), 'idRicetta', $id, FRicetta::getClass());
            }
            if ($oldRicetta[0]->getDosiPersone() != VData::getDosiRicetta()) {
                $pm::update('dosiPersone', VData::getDosiRicetta(), 'idRicetta', $id, FRicetta::getClass());
            }
            header("Location: ../../index.html#/Ricetta/" . $id);
        } else    header('Location: ../../index.html#/Login/0');
    }

    static function eliminaRicetta($id)
    {
        if (CUtente::isLogged()) {
            $pm = USingleton::getInstance('FPersistentManager');
            $ricetta = $pm::search('FRicetta', array(['idRicetta', '=', $id]));
            $session = USingleton::getInstance('USession');
            $utente = unserialize($session->readValue('utente'));
            if ($ricetta[0]->getAutore() == $utente->getId()) {
                $pm::delete('idRicetta', $id, FRicetta::getClass());
                $pm::delete('idRicetta', $id, FRecensione::getClass());
            }
            header("Location: ../../index.html#/Profilo/0");
        } else    header('Location: ../../index.html#/Login/0');
    }

    static function upload(){
        $pm = USingleton::getInstance('FPersistentManager');
        $result = false;
        $max_size = 6000000;
        $result = is_uploaded_file($_FILES['file']['tmp_name']);
        if (!$result){
            //echo "Impossibile eseguire l'upload.";
            return false;
        } else {
            $size = $_FILES['file']['size'];
            if ($size > $max_size){
                //echo "Il file è troppo grande.";
                return false;
            }
            $type = $_FILES['file']['type'];
            $nome = $_FILES['file']['name'];
            $immagine = file_get_contents($_FILES['file']['tmp_name']);
            $image = new EImmagine($nome, $size, $type, base64_encode($immagine));
            $pm::insertMedia($image, 'file');
            return $image->getId();
        }
    }


}