<?php

/*require_once('../Foundation/FPersistentManager.php');
require_once('../Foundation/FRicetta.php');
require_once('../Entity/ERicetta.php');
require_once('../Foundation/Utility/USingleton.php');*/
class CSearch {

    static function getParams(){
        if(isset($_GET['parametri'])){
            $parametri = $_GET['parametri'];
        } else $parametri = '';
        if(isset($_GET['order'])){
            $order = $_GET['order'];
        } else $order = '';
        if(isset($_GET['offset'])){
            $offset = $_GET['offset'];
        } else $offset = '';
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        } else $limit = '';
        if(isset($_GET['like'])){
            $like = $_GET['like'];
        } else $like = '';
        return(array($parametri, $order, $offset, $limit, $like));
    }

    static function getRicette(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $ricette = $pm::search('ERicetta', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $ricette = $pm::search('ERicetta', array(), $params[1], $params[2], $params[3], $params[4]);
        // usando la paginazione per farmi restituire le prime 6 ricette per valutazione otterrò 
        // come risultato le ricette nell'array $ricette['data'],
        // mentre il totale delle ricette trovate nel db sarà memorizzato in $ricette['total']
        for($i = 0; $i < count($ricette['data']); $i++){
            $data = $ricette['data'][$i]->getData();
            $ricette['data'][$i]->setData($data->format('Y-m-d'));
            $ricette['data'][$i]->setIngredienti(unserialize($ricette['data'][$i]->getIngredienti()));
            $categoria = $pm::search('ECategoria', array(['idCategoria', '=', $ricette['data'][$i]->getCategoria()]));
            $ricette['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($ricette);
    }

    static function getPost(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $domande = $pm::search('EPost', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $domande = $pm::search('EPost', array(), $params[1], $params[2], $params[3], $params[4]);
        for($i = 0; $i < count($domande['data']); $i++){
            $data = $domande['data'][$i]->getDataPubblicazione();
            $domande['data'][$i]->setDataPubblicazione($data->format('Y-m-d'));
            $categoria = $pm::search('ECategoria', array(['idCategoria', '=', $domande['data'][$i]->getCategoria()]));
            $domande['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($domande);
    }


    static function getCategorie(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $categorie = $pm::search('ECategoria', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $categorie = $pm::search('ECategoria', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($categorie);
    }

    static function getAutori(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != ''){
            if(is_string($params[0][2])){
                $Autore = $pm::search('EPersona', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
            } else {
                $idAutori = $params[0];
                $Autore = [];
                for ($i = 0; $i < count($idAutori[2]); $i++) {
                    $AutoreArray[$i] = $pm::search('EPersona', array([$idAutori[0], $idAutori[1], $idAutori[2][$i]]), $params[1], $params[2], $params[3], $params[4]);
                    array_push($Autore, $AutoreArray[$i]);
                }
            }
           VData::sendData($Autore);
        }
        else {
            $Autore = $pm::search('EPersona', array(), $params[1], $params[2], $params[3], $params[4]);
            VData::sendData($Autore);
        }
    }

    static function getAutore(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $utente = $pm::search('EPersona', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $utente = $pm::search('EUtente', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($utente);
    }

    static function getRecensione(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $recensione = $pm::search('ERecensione', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $recensione = $pm::search('ERecensione', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($recensione);
    }

    static function getCommento(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $commento = $pm::search('ECommento', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $commento = $pm::search('ECommento', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($commento);
    }

    static function getImmagini(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != ''){
            $idImmagini = $params[0];
            $Immagine = [];
            for($i = 0; $i < count($idImmagini[2]); $i++){
                $ImmagineArray[$i] = $pm::search('EImmagine', array([$idImmagini[0], $idImmagini[1], $idImmagini[2][$i]]), $params[1], $params[2], $params[3], $params[4]);
                array_push($Immagine, $ImmagineArray[$i]);
            }
            for($i = 0; $i < count($Immagine); $i++){
                $qualcosa=$Immagine[$i][0]->getImmagine();
                $Immagine[$i][0]->setImmagine(stream_get_contents($qualcosa));
            }
            VData::sendData($Immagine);
        }
        else {
            $Immagine = $pm::search('EImmagine', array(), $params[1], $params[2], $params[3], $params[4]);

            for($i = 0; $i < count($Immagine); $i++){
                $image = stream_get_contents($Immagine[$i]->getImmagine());
                $Immagine[$i]->setImmagine($image);
            }
            VData::sendData($Immagine);
        }
    }

    static function getImmagine(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $immagine = $pm::search('EImmagine', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $immagine = $pm::search('EImmagine', array(), $params[1], $params[2], $params[3], $params[4]);
        for($i = 0; $i < count($immagine['data']); $i++){
            $image = stream_get_contents($immagine['data'][$i]->getImmagine());
            $immagine['data'][$i]->setImmagine($image);
        }
        VData::sendData($immagine);
    }
}