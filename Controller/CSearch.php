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
        if($params[0] != '') $ricette = $pm::search('FRicetta', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $ricette = $pm::search('FRicetta', array(), $params[1], $params[2], $params[3], $params[4]);
        // usando la paginazione per farmi restituire le prime 6 ricette per valutazione otterrò 
        // come risultato le ricette nell'array $ricette['data'],
        // mentre il totale delle ricette trovate nel db sarà memorizzato in $ricette['total']
        for($i = 0; $i < count($ricette['data']); $i++){
            $data = $ricette['data'][$i]->getData();
            $ricette['data'][$i]->setData($data->format('Y-m-d'));
            //$ricette['data'][$i]->setIngredienti(unserialize($ricette['data'][$i]->getIngredienti()));
            $categoria = $pm::search('FCategoria', array(['idCategoria', '=', $ricette['data'][$i]->getCategoria()]));
            $ricette['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($ricette);
    }

    static function getPost(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $domande = $pm::search('FPost', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $domande = $pm::search('FPost', array(), $params[1], $params[2], $params[3], $params[4]);
        for($i = 0; $i < count($domande['data']); $i++){
            $data = $domande['data'][$i]->getDataPubblicazione();
            $domande['data'][$i]->setDataPubblicazione($data->format('Y-m-d'));
            $categoria = $pm::search('FCategoria', array(['idCategoria', '=', $domande['data'][$i]->getCategoria()]));
            $domande['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($domande);
    }


    static function getCategorie(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $categorie = $pm::search('FCategoria', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $categorie = $pm::search('FCategoria', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($categorie);
    }

    static function getAutore(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $utente = $pm::search('FPersona', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $utente = $pm::search('FUtente', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($utente);
    }

    static function getRecensione(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $recensione = $pm::search('FRecensione', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $recensione = $pm::search('FRecensione', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($recensione);
    }

    static function getCommento(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        if($params[0] != '') $commento = $pm::search('FCommento', array($params[0]), $params[1], $params[2], $params[3], $params[4]);
        else $commento = $pm::search('FCommento', array(), $params[1], $params[2], $params[3], $params[4]);
        VData::sendData($commento);
    }
}