<?php

/*require_once('../Foundation/FPersistentManager.php');
require_once('../Foundation/FRicetta.php');
require_once('../Entity/ERicetta.php');
require_once('../Foundation/Utility/USingleton.php');*/
class CSearch {

    static function homeRicette(){
        $pm = USingleton::getInstance('FPersistentManager');
        $ricetteVotate = $pm::search('FRicetta', array(), 'valutazione', 0, 6);
        // usando la paginazione per farmi restituire le prime 6 ricette per valutazione otterrò 
        // come risultato le ricette nell'array $ricetteVotate['data'],
        // mentre il totale delle ricette trovate nel db sarà memorizzato in $ricetteVotate['total']
        for($i = 0; $i < count($ricetteVotate['data']); $i++){
            $data = $ricetteVotate['data'][$i]->getData();
            $ricetteVotate['data'][$i]->setData($data->format('Y-m-d'));
            $categoria = $pm::search('FCategoria', array(['idCategoria', '=', $ricetteVotate['data'][$i]->getCategoria()]));
            $ricetteVotate['data'][$i]->setCategoria($categoria[0]->getCategoria());
        }
        VData::sendData($ricetteVotate['data']);
    }

    static function homePost(){
        $pm = USingleton::getInstance('FPersistentManager');
        $domande = $pm::search('FPost', array(), 'dataPubblicazione');
        VData::sendData($domande);
    }
}