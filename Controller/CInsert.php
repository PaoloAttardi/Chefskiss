<?php

class CInsert {

    static function pubblicaRicetta(){
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        if(CUtente::isLogged()){
            $id_immagine = self::upload();
            if($id_immagine!=false){
                $utente = unserialize($session->readValue('utente'));
                $autore = $utente->getId();
                $titolo = VData::getTitoloRicetta();
                $procedimento = VData::getProcedimentoRicetta();
                $array = VData::getIngredientiRicetta();
                $ingredienti = serialize($array);
                $categoria = VData::getCategoriaRicetta();
                $dosi = VData::getDosiRicetta();
                $data = new DateTime(date('Y-m-d'));
                $ricetta = new ERicetta($ingredienti, $procedimento, $categoria, $data, $autore, $titolo, $dosi, $id_immagine, $valutazione=0);
                $pm::insert($ricetta);
                header("Location: ../index.html#/Ricetta/" . $ricetta->getId());
            }
            else; //errore caricamento immagine
        }
        else{
            header('Location: ../../index.html#/Login/0');
        }
    }

    static function pubblicaDomanda(){
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        if(CUtente::isLogged()){
            $utente = unserialize($session->readValue('utente'));
            $autore = $utente->getId();
            $titolo = VData::getTitoloRicetta();
            $domanda = VData::getProcedimentoRicetta();
            $categoria = VData::getCategoriaRicetta();
            $data = new DateTime(date('Y-m-d'));
            $post = new EPost($autore, $titolo, $domanda, $categoria, $data);
            $pm::insert($post);
            header("Location: ../index.html#/Post/" . $post->getId());
        }
        else{
            header('Location: ../../index.html#/Login/0');
        }
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
            //echo "Il file ?? troppo grande.";
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

    static function pubblicaRecensione($id){
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        if(CUtente::isLogged()){
            $utente = unserialize($session->readValue('utente'));
            $autore = $utente->getId();
            $testo=VData::getRecensione();
            $valutazione=VData::getValutazione();
            $idRicetta=$id;
            $dataPubblicazione=new DateTime('now');
            $recensione= new ERecensione($testo,$valutazione,$idRicetta,$dataPubblicazione,$autore);
            $recensione->getValutazioneRicetta($recensione);
            $pm::insert($recensione);
            header("Location: ../../index.html#/Ricetta/" . $id);
        }
        else{
            header('Location: ../../index.html#/Login/0');
        }
    }

    static function pubblicaCommento($id){
        $pm = USingleton::getInstance('FPersistentManager');
        $session = USingleton::getInstance('USession');
        if(CUtente::isLogged()){
            $utente = unserialize($session->readValue('utente'));
            $autore = $utente->getId();
            $idPost=$id;
            $testo=VData::getCommento();
            $dataPubblicazione=new DateTime('now');
            $commento=new ECommento($idPost,$autore,$testo,$dataPubblicazione,0);
            $pm::insert($commento);
            header("Location: ../../index.html#/Post/" . $idPost);
        }
        else{
            header('Location:../../index.html#/Login/0');
        }

    }
}
