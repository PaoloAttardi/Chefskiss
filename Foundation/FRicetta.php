<?php

class FRicetta extends Fdb {

    private static $table = 'ricetta';

    private static $class = 'FRicetta';

    private static $values = '(:ingredienti, :procedimento, :categoria, :data, :autore, :nome_ricetta, :dosi_persone, :id_immagine, :valutazione, :id)';

    public function __construct(){
    }

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        echo '';
        return self::$values;
    }



    /**
     * @param PDOStatement $stmt
     * @param ERicetta $ricetta
     */
    public static function bind($stmt, ERicetta $ricetta){
        $stmt->bindValue(':ingredienti', $ricetta->getIngredienti(),PDO::PARAM_STR);
        $stmt->bindValue(':procedimento', $ricetta->getProcedimento(), PDO::PARAM_STR);
        $stmt->bindValue(':categoria', $ricetta->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $ricetta->getData_(), PDO::PARAM_STR);
        $stmt->bindValue(':autore', $ricetta->getAutore(), PDO::PARAM_INT);
        $stmt->bindValue(':nome_ricetta', $ricetta->getNomeRicetta(), PDO::PARAM_STR);
        $stmt->bindValue(':dosi_persone', $ricetta->getDosiPersone(), PDO::PARAM_INT);
        $stmt->bindValue(':id_immagine', $ricetta->getId_immagine(), PDO::PARAM_INT);
        $stmt->bindValue(':valutazione', $ricetta->getValutazione(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $ricetta->getid(), PDO::PARAM_INT);

    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $ricetta = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        //var_dump($result);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $ricetta = new ERicetta($result['ingredienti'], $result['procedimento'], $result['categoria'], $result['data'], $result['autore'], $result['nome_ricetta'], $result['dosi_persone'], $result['id_immagine'], $result['valutazione']);
            self::getValutazioneRicetta($ricetta);
            $ricetta->setId($result['id']);
            self::update('valutazione', self::getValutazioneRicetta($ricetta), 'id', $ricetta->getId());
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $ricetta = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $ricetta[] = new ERicetta($result[$i]['ingredienti'], $result[$i]['procedimento'], $result[$i]['categoria'], $result[$i]['data'], $result[$i]['autore'], $result[$i]['nome_ricetta'], $result[$i]['dosi_persone'], $result[$i]['id_immagine'], $result[$i]['valutazione']);
                    self::getValutazioneRicetta($ricetta[$i]);
                    $ricetta[$i]->setId($result[$i]['id']);
                    self::update('valutazione', self::getValutazioneRicetta($ricetta[$i]), 'id', $ricetta[$i]->getId());
                }
            }
        }
        return $ricetta;
    }

    public static function update($field, $newvalue, $primkey, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $primkey, $val);
        if ($result) return true;
        else return false;
    }

    public static function delete($field, $id){
        $db = parent::getInstance();
        $result = $db->deleteDB(self::getClass(), $field, $id);
        if ($result) return true;
        else return false;
    }

    public static function exist($field, $id){
        $db = parent::getInstance();
        $result = $db->existDB(self::getClass(), $field, $id);
        if ($result != null) return true;
        else return false;
    }

    public static function filterByCategoria($categoria, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $ricetteFiltrate = $db->loadDb(self::$class, array(['categoria', '=', $categoria]), $ordinamento, $limite);
        return $ricetteFiltrate;

    }


    public static function search($parametri=array(), $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function getRows($parametri = array(), $ordinamento = '', $limite = ''){
        $db = parent::getInstance();
        $result = $db->getRowNum(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function getValutazioneRicetta($ricetta){
        $id_ricetta = $ricetta->getId();
        $valutazione = 0;
        $pm = USingleton::getInstance('FPersistentManager');
        $recensione = $pm::load('FRecensione', array(['id_ricetta', '=', $id_ricetta]));
        if($recensione != null){
            if(is_array($recensione)){
                for($i = 0; $i < sizeof($recensione); $i++){
                    if($recensione[$i]->getValutazione() != 0){
                        $voti[] = $recensione[$i]->getValutazione();
                    }
                }
                $valutazione = array_sum($voti)/sizeof($voti);
                $ricetta->setValutazione((int)$valutazione);
            }
            else {
                $valutazione = $recensione->getValutazione();
                $ricetta->setValutazione((int)$recensione->getValutazione());
            }
        }
        else {
            $valutazione = 0;
            $ricetta->setValutazione($valutazione);
        }
        return $valutazione;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }
}