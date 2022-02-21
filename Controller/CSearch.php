<?php

/*require_once('../Foundation/FPersistentManager.php');
require_once('../Foundation/FRicetta.php');
require_once('../Entity/ERicetta.php');
require_once('../Foundation/Utility/USingleton.php');*/
class CSearch {

    static function getParams(){
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
        return(array($order, $offset, $limit, $like));
    }

    static function getRicette(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        $ricetteVotate = $pm::search('FRicetta', array(), $params[0], $params[1], $params[2], $params[3]);
        // usando la paginazione per farmi restituire le prime 6 ricette per valutazione otterrò 
        // come risultato le ricette nell'array $ricetteVotate['data'],
        // mentre il totale delle ricette trovate nel db sarà memorizzato in $ricetteVotate['total']
        for($i = 0; $i < count($ricetteVotate['data']); $i++){
            $data = $ricetteVotate['data'][$i]->getData();
            $ricetteVotate['data'][$i]->setData($data->format('Y-m-d'));
            $categoria = $pm::search('FCategoria', array(['idCategoria', '=', $ricetteVotate['data'][$i]->getCategoria()]));
            $ricetteVotate['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($ricetteVotate);
    }

    static function getPost(){
        $pm = USingleton::getInstance('FPersistentManager');
        $params = self::getParams();
        $domande = $pm::search('FPost', array(), $params[0], $params[1], $params[2], $params[3]);
        for($i = 0; $i < count($domande['data']); $i++){
            $data = $domande['data'][$i]->getDataPubblicazione();
            $domande['data'][$i]->setDataPubblicazione($data->format('Y-m-d'));
            $categoria = $pm::search('FCategoria', array(['idCategoria', '=', $domande['data'][$i]->getCategoria()]));
            $domande['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($domande);
    }
}